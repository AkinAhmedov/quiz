<?php

namespace App\Http\Controllers;

use App\Events\Created;
use App\Events\Deleted;
use App\Events\Updated;
use App\Events\statusChange;
use Illuminate\Http\Request;
use App\To_do_list;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;

class HomePostController extends Controller
{
    public function post_add(Request $request)
     {
         try{
             unset($request['_token']);
             $validator = Validator::make($request->all(), [
                 'title'        => 'required',
                 'description'  => 'required',
                 'deadline'     => 'required',
             ]);

             if ($validator->fails())
                 return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Zorunlu alanları doldurunuz!']);

             $request->merge(['user_id' => Auth::user()->id]);
             To_do_list::create($request->all());
             return response(['durum'=>'success', 'baslik'=>'Başarılı', 'icerik'=>'Başarıyla kayıt yapıldı !', 'hata' => '']);
         }
         catch (\Exception $e){
             return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt Yapılamadı !', 'hata'=>$e->getMessage()]);
         }
     }

    public function post_update(Request $request, $id)
    {
        try {
            unset($request['_token']);
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'deadline' => 'required',
            ]);

            if ($validator->fails())
                return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Zorunlu alanları doldurunuz!']);

            $request->merge(['user_id' => Auth::user()->id]);
            To_do_list::where('id', $id)->update($request->all());
            event(new Updated($request));
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt Başarıyla Güncellendi !', 'hata' => '']);
        }
        catch (\Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt Yapılamadı !', 'hata' => $e->getMessage()]);
        }

    }

    public function post_action(Request $request)
    {
        try{
            unset($request['_token']);
            if ($request->action == 'Sil')
            {
                $data = To_do_list::where('id', $request->id)->get()->first();
                To_do_list::where('id', $request->id)->update(['deleted' => 1]);
                event(new Deleted($data));
                return response(['durum'=>'success', 'baslik'=>'Başarılı', 'icerik'=>'Kayıt Başarıyla Silindi !', 'hata' => '']);
            }

            if (($request->action == 'Tamamlanmadı') || ($request->action == 'Tamamlandı'))
            {
                $newstatus = ($request->action=='Tamamlandı') ? 1 : 2;
                $data = To_do_list::where('id', $request->id)->get()->first();
                To_do_list::where('id', $request->id)->update(['status' => $newstatus]);
                event(new statusChange($data));
                return response(['durum'=>'success', 'baslik'=>'Başarılı güncelleme', 'icerik'=>'Durum Başarıyla Güncellendi.', 'hata'=>'']);
            }
        }
        catch (\Exception $e)
        {
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'Kayıt Yapılamadı !', 'hata'=>$e->getMessage()]);
        }
    }
}
