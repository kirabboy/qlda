<?php

namespace App\Http\Controllers;

use App\DataTables\Download_filesDataTable;
use App\Models\Down_file;
use Illuminate\Http\Request;

class DownloadFileController extends Controller
{
    public $model;
    public function __construct()
    {
        $this->model = new Down_file();
    }
    public function index(Download_filesDataTable $datatables)
    {
        return $datatables->render('file_download.index');
    }
    public function destroy($id)
    {
        $file_download = $this->model->FindOrFail($id);
        $file_download->delete();
        return redirect()->route('file_download.index')->with('success', __('Delete success'));
    }
}
