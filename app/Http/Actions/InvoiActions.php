<?php

namespace App\Http\Actions;

use Illuminate\Support\Facades\DB;

class InvoiActions
{
    //Create items in invoice
    public function createInvoiceLines(string $tableName, array $data)
    {
        Db::table($tableName)->insert($data);
    }
    //Delete items in invoice
    public function deleteItemInvoice(int $id,$tableName)
    {
        DB::table($tableName)->where('id', $id)->delete();
    }
    //Update qty items in invoice
    public function udateItemInvoiceQty(int $id, string $tableName, $qty)
    {
        DB::table($tableName)
            ->where('id', $id)
            ->update([
                'qty' => $qty
            ]);
    }
    //Check if tem exist on invoice
    public function checkIfItemExistOnInvoice(
        string $tableName,
        string $columnItemInvoiceId,
        int $idTarif,
        int $id_invoice):bool
    {
        $status=false;
        $items=DB::table($tableName)->where($columnItemInvoiceId,$id_invoice)->get();
        foreach ($items as $item) {
            if ($item->tarification_id==$idTarif) {
                $status=true;
            }else{
                $status=false;
            }
        }

        return $status;
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
    public function deleteInvoice($id, $tableName): void
    {
        DB::table($tableName)->where('id', $id)->delete();
    }
}
