<?php

namespace App\Http\Actions;

use App\Http\Resources\InvoicePrivateResource;
use App\Models\CategoryTarification;
use App\Models\InvoicePrivate;
use Illuminate\Support\Facades\DB;

class InvoiActions
{
    /**
     * Update quantity of item invoice
     *
     * @return Illuminate\Support\Facades\DB query
     *
     * @param (string $tablename, array $dataInputs)
     */
    public function createInvoiceLines(string $tableName, array $data)
    {
        DB::table($tableName)->insert($data);
    }
    /**
     * Update quantity of item invoice
     *
     * @return Illuminate\Support\Facades\DB query
     *
     * @param (int $id,string $tablename,init $qty)
     */
    public function udateItemInvoiceQty(int $id, string $tableName, int $qty)
    {
        DB::table($tableName)
            ->where('id', $id)
            ->update([
                'qty' => $qty
            ]);
    }
    /**
     * Delete item on invoice
     *
     * @return Illuminate\Support\Facades\DB query
     *
     * @param (int $id,string $tablename)
     */
    public function deleteInvoiceItem($id, $tableName): void
    {
        DB::table($tableName)->where('id', $id)->delete();
    }
    /**
     * Check if item you to save exist in invoice
     *
     * @return Illuminate\Support\Facades\DB query
     *
     * @param (string $tablename,string $columnNameTochek,string $invoiceId)
     */
    public function checkIfItemExistOnInvoice(
        string $tableName,
        string $columnItemInvoiceId,
        int $id_invoice,
    ) {
        $items = DB::table($tableName)->where($columnItemInvoiceId, $id_invoice)->get();
        return $items;
    }
    /**
     * Enable status of invoice by invoice column
     *
     * @return Illuminate\Support\Facades\DB query
     *
     * @param (int $id,string $tablename)
     */
    public function enableStatusInvoice($id, $tableName, $columnStatus): void
    {
        DB::table($tableName)
            ->where('id', $id)
            ->update([
                $columnStatus => true
            ]);
    }
    /**
     * Disable status of invoice by invoice column
     *
     * @return Illuminate\Support\Facades\DB query
     *
     * @param (int $id,string $tablename)
     */
    public function disableStatusInvoice($id, $tableName, $columnStatus): void
    {
        DB::table($tableName)
            ->where('id', $id)
            ->update([
                $columnStatus => false
            ]);
    }

    public function getInvoiceItem($id)
    {
        $invoice = InvoicePrivate::find($id);
        $consultation = $invoice->consultation;
        $items_invoice = DB::table('invoice_private_tarification')->where('invoice_private_id', $invoice->id)
            ->join(
                'tarifications',
                'tarifications.id',
                '=',
                'invoice_private_tarification.tarification_id'
            )
            ->join(
                'category_tarifications',
                'category_tarifications.id',
                '=',
                'tarifications.category_tarification_id'
            )
            ->select(
                'category_tarifications.name as category',
                'invoice_private_tarification.id',
                'tarifications.name',
                'tarifications.price_private',
                'invoice_private_tarification.qty'
            )
            ->groupBy(
                'category',
                'invoice_private_tarification.id',
                'tarifications.name',
                'tarifications.price_private',
                'invoice_private_tarification.qty'
            )
            ->get();
        $groupedItems = [];
        $total_invoice = 0;
        foreach ($items_invoice as $item) {
            $category = $item->category;
            // Si la clé de catégorie n'existe pas encore dans le tableau, on l'initialise
            if (!isset($groupedItems[$category])) {
                $groupedItems[$category] = ['data' => []];
            }
            // Ajouter l'élément au tableau associatif pour cette catégorie
            $groupedItems[$category]['data'][] = [
                'id' => $item->id,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => request('currency') == 'CDF'
                    ? number_format($item->price_private * $invoice->rate->amount, 1, ',', ' ')
                    : number_format($item->price_private, 1, ',', ' '),
                'total' =>
                request('currency') == 'CDF'
                    ? number_format($item->price_private * $item->qty * $invoice->rate->amount, 1, ',', ' ')
                    : number_format($item->price_private * $item->qty, 1, ',', ' ')
            ];
            $total_invoice += $item->price_private * $item->qty;
        }
        return [
            'total_invoice' => request('currency') == 'CDF'
                ? number_format(($total_invoice + $consultation->price_private) * $invoice->rate->amount, 1, ',', ' ')
                : number_format($total_invoice + $consultation->price_private, 1, ',', ' '),
            'consultation' => [
                'name' => $consultation->name,
                'amount' => request('currency') == 'CDF'
                    ? number_format($consultation->price_private * $invoice->rate->amount, 1, ',', ' ')
                    : number_format($consultation->price_private, 1, ',', ' ')
            ],
            'data' => $groupedItems,
        ];
    }
}
