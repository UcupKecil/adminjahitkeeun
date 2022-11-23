<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Hash;

class TaylorController extends Controller
{
    public function index()
    {
        $taylor = DB::table('taylors')->get();


        $data = [
            'taylor' => $taylor,
            'script'   => 'components.scripts.taylor'
        ];

        return view('pages.taylor', $data);
    }

    public function show($id) {
        if(is_numeric($id)) {
            $data = DB::table('taylors')
            ->join('users', 'taylors.user_id', '=', 'users.id')

            ->select([
                'taylors.*','users.name','users.email'
            ])->where('taylors.user_id', $id)->first();

            //$data->status = number_format($data->status);

            return Response::json($data);
        }

        $data = DB::table('taylors')
            ->join('users', 'taylors.user_id', '=', 'users.id')

            ->select([
                'taylors.*','users.name','users.email'
            ])
            ->orderBy('taylors.id', 'desc');

        return DataTables::of($data)

        ->editColumn(
            'photo',
            function($row) {
                $data = [
                    'photo' => $row->photo
                ];

                return view('components.img.taylor', $data);
            }
        )

            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->user_id,

                    ];

                    return view('components.buttons.taylor', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {

        $extension = $request->file('cover')->getClientOriginalExtension();
        $cover = date('YmdHis').'.'.$extension;
        $path = '/home/mvlrzxvo/subdomain/api.tepat.co.id/photo-user/';
        $request->file('cover')->move($path, $cover);

        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama taylor',
                'status'    => false
            ];

        }
        if($request->email == NULL) {
            $json = [
                'msg'       => 'Mohon masukan email taylor',
                'status'    => false
            ];

        }
        if($request->phone == NULL) {
            $json = [
                'msg'       => 'Mohon masukan phone taylor',
                'status'    => false
            ];

        }
        if($request->placeBirth == NULL) {
            $json = [
                'msg'       => 'Mohon masukan placebirth taylor',
                'status'    => false
            ];

        }
        if($request->dateBirth == NULL) {
            $json = [
                'msg'       => 'Mohon masukan datebirth taylor',
                'status'    => false
            ];

        } else {


            try{
                DB::transaction(function() use($request,$cover) {
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make('password'),
                        'status' => '1',
                        'created_at' => date('Y-m-d H:i:s'),

                    ]);

                    DB::table('model_has_roles')->insert([
                        'role_id' => 2,
                        'model_type' => 'App\User',
                        'model_id' => $user->id
                    ]);


                    DB::table('taylors')->insert([
                        'user_id' => $user->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'phone' => $request->phone,
                        'datebirth' => date($request->dateBirth),
                        'placebirth' => $request->placeBirth,
                        'photo' => $cover,
                        'status' => 1,
                    ]);
                });

                $json = [
                    'msg' => 'Taylor berhasil ditambahkan',
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
            $path = '/home/mvlrzxvo/subdomain/api.tepat.co.id/photo-user/';
            $request->file('coverEdit')->move($path, $name);

        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama taylor',
                'status'    => false
            ];
        }  else {
            try{
              DB::transaction(function() use($request, $id,$name) {
                  DB::table('taylors')->where('user_id', $id)->update([
                      'updated_at' => date('Y-m-d H:i:s'),
                      'phone' => $request->phone,
                      'placebirth' => $request->placebirth,
                      'datebirth' => $request->datebirth,
                      'photo' => $name,

                  ]);

                  DB::table('users')->where('id', $id)->update([
                    'updated_at' => date('Y-m-d H:i:s'),
                    'name' => $request->name,
                    'email' => $request->email,

                ]);
              });

                $json = [
                    'msg' => 'Taylor berhasil dirubah',
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
                  DB::table('taylors')->where('user_id', $id)->delete();
              });
              
              DB::transaction(function() use($id) {
                DB::table('model_has_roles')->where('model_id', $id)->delete();
            });


              DB::transaction(function() use($id) {
                DB::table('users')->where('id', $id)->delete();
                });

                $json = [
                    'msg' => 'Taylor berhasil dihapus',
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
