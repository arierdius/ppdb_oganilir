<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'status' => Response::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY],
                'message' => 'Lengkapi Data',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->username)->first();


        if ($user) {

            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                $user->image = $user->image ? asset('/storage/images/users/' . $user->image) : null;

                // update user set token
                // $user = User::where('email', $request->username)->first();
                // $user->remember_token = $token;
                // $user->save();

                return response()->json([
                    'code' => Response::HTTP_OK,
                    'status' => Response::$statusTexts[Response::HTTP_OK],
                    'message' => 'Login Berhasil',
                    'data' => [
                        'token' => $token
                    ]
                ], 200);
            } else {
                return response()->json([
                    'code' => Response::HTTP_UNAUTHORIZED,
                    'status' => Response::$statusTexts[Response::HTTP_UNAUTHORIZED],
                    'message' => 'Password Salah',
                ], 401);
            }
        } else {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'status' => Response::$statusTexts[Response::HTTP_NOT_FOUND],
                'message' => 'User Tidak Ditemukan',
            ], 404);
        }
    }

    // api insert foto
    public function add_koordinat(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
        //         'status' => Response::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY],
        //         'message' => 'Lengkapi Data',
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        $image = $request->file('foto');
        $filename = Str::random(10) . '.' . $image->getClientOriginalExtension();
        Storage::disk('public_uploads')->putFileAs('/storage/pendukung_koordinat/', $image, $filename);
        $name = $filename;

        // // upload foto
        // $image = $request->file('foto');
        // $name = Str::random(10) . '.' . $image->getClientOriginalExtension();
        // $destinationPath = public_path('/storage/pendukung_koordinat/');
        // $img = Image::make($image->getRealPath());
        // // resize
        // $img->resize(500, 500, function ($constraint) {
        //     $constraint->aspectRatio();
        // });
        // $img->save($destinationPath . '/' . $name);


        $accessToken = $request->bearerToken();

        // Get access token from database
        $token = PersonalAccessToken::findToken($accessToken);
        $edit_users = User::where('id', $token->tokenable_id)->first();

        $edit_users->latitude = $request->lat;
        $edit_users->longitude = $request->long;
        $edit_users->pendukung_jarak = $name;
        $edit_users->generate_lokasi = '1';
        $edit_users->save();

        return response()->json([
            'code' => Response::HTTP_OK,
            'status' => Response::$statusTexts[Response::HTTP_OK],
            'message' => 'Data Koordinat Berhasil Disimpan',
        ], 200);
    }

    // cek data
    public function check_data(Request $request)
    {

        $accessToken = $request->bearerToken();

        // Get access token from database
        $token = PersonalAccessToken::findToken($accessToken);
        $user = User::where('id', $token->tokenable_id)->first();

        if ($user) {
            $data_user = [
                'id' => $user->id,
                'name' => $user->name,
                'latitude' => $user->latitude,
                'longitude' => $user->longitude,
                'pendukung_jarak' => $user->pendukung_jarak ? asset('/storage/pendukung_koordinat/' . $user->pendukung_jarak) : null,
                'generate_lokasi' => $user->generate_lokasi,
            ];
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => Response::$statusTexts[Response::HTTP_OK],
                'message' => 'Data ditemukan',
                'data' => $data_user
            ], 200);
        } else {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'status' => Response::$statusTexts[Response::HTTP_NOT_FOUND],
                'message' => 'User Tidak Ditemukan',
            ], 404);
        }
    }

    public function logout(Request $request)
    {
        $accessToken = $request->bearerToken();

        // Get access token from database
        $token = PersonalAccessToken::findToken($accessToken);
        // dd($token);
        // Revoke token
        $token->delete();

        return response()->json([
            'code' => Response::HTTP_OK,
            'status' => Response::$statusTexts[Response::HTTP_OK],
            'message' => 'Logout Berhasil',
        ], 200);
    }
}
