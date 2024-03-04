<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserProfileController extends Controller
{

    public function update(Request $request, User $user)
    {


        $datos = $request->except(['imagen']);


        $user->update($datos);


        if ($request->hasFile('imagen')) {
            $imageName = time() . '.' . $request->imagen->extension();
            $request->imagen->storeAs('images', $imageName, 'public');
            $user->imagen = $imageName;
            $user->save();
        }



        session()->flash('success', 'Perfil actualizado correctamente');

        return redirect()->route('perfil');
    }

}
