<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectContactDataTable;
use App\DataTables\ProjectDataTable;
use App\Enums\Projectcontract;
use App\Enums\Projectmaterial;
use App\Enums\Projectsample;
use App\Enums\Projectstatus;
use App\Models\Admins;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function index(ProjectDataTable $datatable)
    {
        return $datatable->render('project.index');
    }
    public function add()
    {
        $status = Projectstatus::getInstances();
        $status_sample = Projectsample::getInstances();
        $status_contract = Projectcontract::getInstances();
        $status_material = Projectmaterial::getInstances();
        return view('project.add', compact('status', 'status_sample', 'status_contract', 'status_material'));
    }
    public function store(Request $request)
    {
        $request->merge(['admin_id' => auth()->user()->id]);
        if ($request->has('file_upload')) {
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
            $explodeImage = explode('.', $request->file_upload);
            $extension = end($explodeImage);
            if (in_array($extension, $imageExtensions)) {
                $file = str_replace('http://localhost/appqlda/file-upload/images/', '', $request->file_upload);
                $request->merge(['file_upload' => $file]);
            } else {
                $file = str_replace('http://localhost/appqlda/file-upload/files/', '', $request->file_upload);
                $request->merge(['file_upload' => $file]);
            }
        }
        Projects::create($request->all());
        return redirect()->route('project.index')->with('success', 'Thêm dự án thành công!');
    }
    public function detail($id)
    {
        $project = Projects::FindOrFail($id);
        return view('project.detail', compact('project'));
    }
    public function edit($id)
    {
        $status = Projectstatus::getInstances();
        $status_sample = Projectsample::getInstances();
        $status_contract = Projectcontract::getInstances();
        $status_material = Projectmaterial::getInstances();
        $project = Projects::FindOrFail($id);
        return view('project.edit', compact('project', 'status', 'status_sample', 'status_contract', 'status_material'));
    }
    public function update(Request $request, $id)
    {
        $project = Projects::FindOrFail($id);
        if ($request->has('file_upload')) {
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
            $explodeImage = explode('.', $request->file_upload);
            $extension = end($explodeImage);
            if (in_array($extension, $imageExtensions)) {
                $file = str_replace('http://localhost/appqlda/file-upload/images/', '', $request->file_upload);
                $request->merge(['file_upload' => $file]);
            } else {
                $file = str_replace('http://localhost/appqlda/file-upload/files/', '', $request->file_upload);
                $request->merge(['file_upload' => $file]);
            }
        }
        $project->update($request->all());
        return redirect()->route('project.index')->with('success', 'Cập nhật thành công!');
    }
    public function destroy($id)
    {
        $project = Projects::FindOrFail($id);
        $project->delete();
        return redirect()->route('project.index')->with('success', 'Xoá thành công!');
    }
    public function downloadFile($file_upload)
    {
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
        $explodeImage = explode('.', $file_upload);
        $extension = end($explodeImage);
        if (in_array($extension, $imageExtensions)) {
            $path = public_path('/file-upload/images/' . $file_upload);
        } else {
            $path = public_path('/file-upload/files/' . $file_upload);
        }
        if (!File::exists($path)) {
            return response()->json(['error' => 'File not found.'], 404);
        }
        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $file_upload . '"',
        ];
        return response()->download($path, $file_upload, $headers);
    }
}
