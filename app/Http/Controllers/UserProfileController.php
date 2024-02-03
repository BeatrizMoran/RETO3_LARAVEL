<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Asegúrate de que esta sea la ruta correcta al modelo User

class UserProfileController extends Controller
{
     /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {


        $datos = $request->except(['imagen']);


        $user->update($datos);

        // Si se proporciona una nueva imagen, almacenarla y actualizar la propiedad 'imagen'
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
