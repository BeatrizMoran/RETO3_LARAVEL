<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /*
        $user = auth()->user();

        // Verifica el rol del usuario para la acción específica
        switch ($this->route()->getName()) {
            case 'productos.index':
            case 'productos.show':
                return $user->hasAnyRole(['admin', 'responsable', 'comercial']); // Todos los roles pueden ver la lista y detalles de productos

            case 'productos.create':
                return $user->hasAnyRole(['admin', 'responsable']); // Solo los usuarios con los roles 'admin' y 'responsable' pueden crear productos

            case 'productos.edit':
            case 'productos.update':
            case 'productos.destroy':
                return $user->hasAnyRole(['admin', 'responsable']); // Solo los usuarios con los roles 'admin' y 'responsable' pueden actualizar o borrar productos

            default:
                return false; // Acción no reconocida, denegar por defecto
        }
        */

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif',
            'formato' => 'required|in:20CL,25CL,33CL,1L,Barril',
            'codigo_referencia' => 'unique'
        ];
    }
}
