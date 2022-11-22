<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ShippingMethodController extends Controller
{
    public function index()
    {
        $shippingmethod = DB::table('shipping_methods')->get();

        $data = [
            'shippingmethod' => $shippingmethod,
            'script'   => 'components.scripts.shippingmethod'
        ];

        return view('pages.shippingmethod', $data);
    }

    public function show($id) {
        if(is_numeric($id)) {
            $data = DB::table('shipping_methods')->where('id', $id)->first();

            //$data->status = number_format($data->status);

            return Response::json($data);
        }

        $data = DB::table('shipping_methods')

            ->select([
                'shipping_methods.*'
            ])
            ->orderBy('shipping_methods.id', 'desc');

        return DataTables::of($data)

        ->editColumn(
            'photo',
            function($row) {
                $data = [
                    'photo' => $row->photo
                ];

                return view('components.img.shippingmethod', $data);
            }
        )

            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id,

                    ];

                    return view('components.buttons.shippingmethod', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {

        $extension = $request->file('cover')->getClientOriginalExtension();
        $cover = date('YmdHis').'.'.$extension;
        $path = base_path('public/photo-shippingmethod');
        $request->file('cover')->move($path, $cover);

        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama Shipping Methode',
                'status'    => false
            ];

        } else {


            try{
                DB::transaction(function() use($request,$cover) {
                    DB::table('shipping_methods')->insert([
                        'created_at' => date('Y-m-d H:i:s'),
                        'name' => $request->name,
                        'photo' => $cover,

                    ]);
                });

                $json = [
                    'msg' => 'ShippingMethod Berita berhasil ditambahkan',
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
            $path = base_path('public/photo-shippingmethod');
            $request->file('coverEdit')->move($path, $name);

        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama shippingmethod',
                'status'    => false
            ];
        }  else {
            try{
              DB::transaction(function() use($request, $id,$name) {
                  DB::table('shipping_methods')->where('id', $id)->update([
                      'updated_at' => date('Y-m-d H:i:s'),
                      'name' => $request->name,
                      'photo' => $name,

                  ]);
              });

                $json = [
                    'msg' => 'Shipping Methode berhasil dirubah',
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
                  DB::table('shipping_methods')->where('id', $id)->delete();
              });

                $json = [
                    'msg' => 'Shipping Methode berhasil dihapus',
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
