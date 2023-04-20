<?php

namespace App\Http\Actions;

use Illuminate\Support\Facades\DB;

class InvoiActions{
    public function enableStatusInvoice($id,$tableName,$columnStatus):void{
        DB::table($tableName)
        ->where('id', $id)
        ->update([
            $columnStatus => true
        ]);
    }
    public function disableStatusInvoice($id,$tableName,$columnStatus):void{
        DB::table($tableName)
        ->where('id', $id)
        ->update([
            $columnStatus => false
        ]);
    }
    public function deleteInvoice($id,$tableName):void{
        DB::table($tableName)->where('id',$id)->delete();
    }
}
