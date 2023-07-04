<?php

namespace App\Http\Controllers;

use App\DataTables\LibraryDataTable;
use App\Enums\Librarystatus;
use App\Models\Down_file;
use App\Models\Library;
use App\Models\Project_report;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LibraryController extends Controller
{
    public $project, $project_report, $library, $status, $file_download;
    public function __construct()
    {
        $this->project = new Projects();
        $this->project_report = new Project_report();
        $this->library = new Library();
        $this->file_download = new Down_file();
        $this->status = Librarystatus::getValues();
    }
    public function index(LibraryDataTable $datatable)
    {           
        return $datatable->render('library.index');
    }
    public function library_status($id, Request $request)
    {
        $library_status = $this->library->FindOrFail($id);
        if ($library_status) {
             $library_status->status = $request->status;
        $library_status->update();
        return response()->json([
            'status' => 200,
            'success' => 'Update successfully!',
        ]);
        }else{
            return response()->json([
                'status' => 400,
                'error' => 'No update successfully!',
            ]);
        }
    }
    public function store_file_download(Request $request){
        $library = $this->library->FindOrFail($request->id);
        $request->merge(['employee_id' =>  $library->project_report->employee_id]);
        $request->merge(['library_id' => $request->id]);
        $this->file_download->create($request->all());
    }
    public function destroy($id){
        $library = $this->library->FindOrFail($id);
        $library->delete();
        return redirect()->route('library.index')->with('success', trans('Delete success'));
    }
    public function edit($id){
        $project = $this->project->all();
        $project_report = $this->project_report->all();
        $library = $this->library->FindOrFail($id);
        return view('library.edit', compact('library', 'project', 'project_report'));
    }
    public function update(Request $request, $id){
        $library = $this->library->FindOrFail($id);
        $library->update($request->all());
        $request->merge(['file_report' => $request->filename]);
        $project_report = $this->project_report->FindOrFail($request->project_report_id);
        $project_report->update($request->all());
        return back()->with('success', trans('Edit success'));
    }
    public function downloadFile($file_report)
    {
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
        $explodeImage = explode('.', $file_report);
        $extension = end($explodeImage);
        if (in_array($extension, $imageExtensions)) {
            $path = public_path('/file-upload/images/' . $file_report);
        } else {
            $path = public_path('/file-upload/files/' . $file_report);
        }
        if (!File::exists($path)) {
            return view('errors.404');
        }
        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $file_report . '"',
        ];
        return response()->download($path, $file_report, $headers);
    }
}
