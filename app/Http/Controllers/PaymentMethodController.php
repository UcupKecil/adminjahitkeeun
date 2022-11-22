<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentmethod = DB::table('payment_methods')->get();

        $data = [
            'paymentmethod' => $paymentmethod,
            'script'   => 'components.scripts.paymentmethod'
        ];

        return view('pages.paymentmethod', $data);
    }

    public function show($id) {
        if(is_numeric($id)) {
            $data = DB::table('payment_methods')->where('id', $id)->first();

            //$data->status = number_format($data->status);

            return Response::json($data);
        }

        $data = DB::table('payment_methods')

            ->select([
                'payment_methods.*'
            ])
            ->orderBy('payment_methods.id', 'desc');

        return DataTables::of($data)

        ->editColumn(
            'photo',
            function($row) {
                $data = [
                    'photo' => $row->photo
                ];

                return view('components.img.paymentmethod', $data);
            }
        )

            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id,

                    ];

                    return view('components.buttons.paymentmethod', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {

        $extension = $request->file('cover')->getClientOriginalExtension();
        $cover = date('YmdHis').'.'.$extension;
        $path = base_path('public/photo-paymentmethod');
        $request->file('cover')->move($path, $cover);

        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama Payment Methode',
                'status'    => false
            ];

        } else {


            try{
                DB::transaction(function() use($request,$cover) {
                    DB::table('payment_methods')->insert([
                        'created_at' => date('Y-m-d H:i:s'),
                        'name' => $request->name,
                        'photo' => $cover,

                    ]);
                });

                $json = [
                    'msg' => 'PaymentMethod Berita berhasil ditambahkan',
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
            $path = base_path('public/photo-paymentmethod');
            $request->file('coverEdit')->move($path, $name);

        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama paymentmethod',
                'status'    => false
            ];
        }  else {
            try{
              DB::transaction(function() use($request, $id,$name) {
                  DB::table('payment_methods')->where('id', $id)->update([
                      'updated_at' => date('Y-m-d H:i:s'),
                      'name' => $request->name,
                      'photo' => $name,

                  ]);
              });

                $json = [
                    'msg' => 'Payment Methode berhasil dirubah',
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
                  DB::table('payment_methods')->where('id', $id)->delete();
              });

                $json = [
                    'msg' => 'Payment Methode berhasil dihapus',
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
