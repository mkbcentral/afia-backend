<?php

namespace App\Http\Actions;

use App\Http\Resources\InvoicePrivateResource;
use App\Models\CategoryTarification;
use App\Models\InvoicePrivate;
use Illuminate\Support\Facades\DB;

class InvoiActions
{
    //Create items in invoice
    public function createInvoiceLines(string $tableName, array $data)
    {
        Db::table($tableName)->insert($data);
    }
    //Delete items in invoice
    //Update qty items in invoice
    public function udateItemInvoiceQty(int $id,  $tableName, $qty)
    {
        DB::table($tableName)
            ->where('id', $id)
            ->update([
                'qty' => $qty
            ]);
    }
    //Delete invoice item
    public function deleteInvoiceItem($id, $tableName): void
    {
        DB::table($tableName)->where('id', $id)->delete();
    }
    //Check if tem exist on invoice
    public function checkIfItemExistOnInvoice(
        string $tableName,
        string $columnItemInvoiceId,
        int $id_invoice,
    ) {
        $items = DB::table($tableName)->where($columnItemInvoiceId, $id_invoice)->get();
        return $items;
    }
    //Enable status invoice
    public function enableStatusInvoice($id, $tableName, $columnStatus): void
    {
        DB::table($tableName)
            ->where('id', $id)
            ->update([
                $columnStatus => true
            ]);
    }
    //Disable status invoice
    public function disableStatusInvoice($id, $tableName, $columnStatus): void
    {
        DB::table($tableName)
            ->where('id', $id)
            ->update([
                $columnStatus => false
            ]);
    }
    //Delete invoice item

}
