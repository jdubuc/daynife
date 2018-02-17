<?php

namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'itemFactura';


    public $errors;

    public function isValid($data)
    {
        $rules = array(
            'descripcion' => 'required|max:255',
            'cantidad' => 'required|max:255',
            'precioUnitario' => 'required|max:255',
            'subtotal' => 'required|max:255',
            'idTipoFactura' => 'required|max:255',
            'idEmpresa' => 'required|max:255'
        );
         

        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   /* protected $fillable = ['name', 'email', 'password'];*/
   
    protected $fillable = array('descripcion','cantidad','precioUnitario','subtotal','idTipoFactura','idEmpresa');
}
