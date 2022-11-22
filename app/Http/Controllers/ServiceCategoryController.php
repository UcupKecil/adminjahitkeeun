<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $servicecategory = DB::table('service_categories')->get();

        $data = [
            'servicecategory' => $servicecategory,
            'script'   => 'components.scripts.servicecategory'
        ];

        return view('pages.servicecategory', $data);
    }

    public function show($id) {
        if(is_numeric($id)) {
            $data = DB::table('service_categories')->where('id', $id)->first();

            //$data->status = number_format($data->status);

            return Response::json($data);
        }

        $data = DB::table('service_categories')

            ->select([
                'service_categories.*'
            ])
            ->orderBy('service_categories.id', 'desc');

        return DataTables::of($data)

        ->editColumn(
            'photo',
            function($row) {
                $data = [
                    'photo' => $row->photo
                ];

                return view('components.img.servicecategory', $data);
            }
        )

            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id,

                    ];

                    return view('components.buttons.servicecategory', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {

        $extension = $request->file('cover')->getClientOriginalExtension();
        $cover = date('YmdHis').'.'.$extension;
        $path = '/home/mvlrzxvo/subdomain/api.tepat.co.id/photo-item/';
        $request->file('cover')->move($path, $cover);

        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama service category',
                'status'    => false
            ];

        } else {


            try{
                DB::transaction(function() use($request,$cover) {
                    DB::table('service_categories')->insert([
                        'created_at' => date('Y-m-d H:i:s'),
                        'name' => $request->name,
                        'photo' => $cover,

                    ]);
                });

                $json = [
                    'msg' => 'ServiceCategory Berita berhasil ditambahkan',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }
        }

        return Response::json($json);
    }

    public function edit(Request $request, $id)
    {


            $extension = $request->file('coverEdit')->getClientOriginalExtension();
            $name = date('YmdHis').''.$id.'.'.$extension;
            $path = '/home/mvlrzxvo/subdomain/api.tepat.co.id/photo-item/';
            $request->file('coverEdit')->move($path, $name);

        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama servicecategory',
                'status'    => false
            ];
        }  else {
            try{
              DB::transaction(function() use($request, $id,$name) {
                  DB::table('service_categories')->where('id', $id)->update([
                      'updated_at' => date('Y-m-d H:i:s'),
                      'name' => $request->name,
                      'photo' => $name,

                  ]);
              });

                $json = [
                    'msg' => 'Service Category berhasil dirubah',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }
        }

        return Response::json($json);
    }

    public function destroy($id)
    {

            try{

              DB::transaction(function() use($id) {
                  DB::table('service_categories')->where('id', $id)->delete();
              });

                $json = [
                    'msg' => 'Service Category Berita berhasil dihapus',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }


        return Response::json($json);
    }
}
