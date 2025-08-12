namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPerbulan extends Model
{
    protected $fillable = [
        'user_id', 'nama_file',
    ];
}
