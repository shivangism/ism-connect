<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Http\Request;

class download2Controller extends Controller
{
    public function download()
    {
        return (new InvoicesExport())->download('data.xlsx');
    }
}

class InvoicesExport implements WithMultipleSheets
{
    use Exportable;
    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $tables = DB::select('SHOW TABLES');
        foreach($tables as $table)
        {  
            $name=$table->Tables_in_laravel;
            $sheets[] = new InvoicesPerTableSheet($name);
    }

        return $sheets;
    }
}

class InvoicesPerTableSheet implements FromCollection, WithTitle
{
    private $name;


    public function __construct( string $name)
    {
        $this->name = $name;
    }

    /**
     * @return Builder
     */
    public function collection()
    {
        return
        collect(DB::select('select * from '.$this->name));
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return  $this->name;
    }
}