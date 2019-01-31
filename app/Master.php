<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DB;

/**
 * Master
 *
 * @package                
 * @subpackage             Master
 * @category               Model
 * @DateOfCreation         22 aug 2018
 * @ShortDescription       The model is is connected to the maintenance_master table and you can perform
 *                         relevant operation with respect to this class
 */
class Master extends Model
{
    use Notifiable;
    /**
    *@ShortDescription Table for the Users.
    *
    * @var String
    */
    protected $table = 'maintenance_master';
    
    /**
     *@ShortDescription The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'maintenance_amount','flat_type_id','id','created_at',
    ];

    /**
     *@ShortDescription The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password',
    ];

    /**
        * @DateOfCreation         27 Aug 2018
        * @ShortDescription       This function selects the specified data from table and count
        * @return                 result
        */
    public function getFlatId($user_id)
    {
        return DB::table('flat_type')
        ->where('id', '=', $user_id)->count();
    }

    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       This function selects the specified data from table
    * @return                 result
    */
    public function findFlatId($user_id)
    {
        return DB::table('flat_type')
        ->where('id', '=', $user_id)->get()->toArray();
    }

    /**
     * @DateOfCreation       11 September 2018
     * @DateOfDeprecated
     * @ShortDescription     This function insert the specified data into table
     * @LongDescription
     * @param  string $table_name
     * @param  array  $insert_array
     * @return void
     */
    public static function insert($table_name = '', $insert_array = [])
    {
        return DB::table($table_name)->insertGetId($insert_array);
    }

    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       This function selects the specified data from table
    * @return                 result
    */
    public function selectFlatType()
    {
        return DB::table('flat_type')->get();
    }
    
   /**
    * @DateOfCreation         27 oct 2018
    * @ShortDescription       This function delete the specified row from table
    * @return                 result
    */
   public static function deleteMaintenanceMastere($user_id)
   {
     return DB::table('maintenance_master')->where('id', '=', $user_id)->delete();
   }

}