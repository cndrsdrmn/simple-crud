<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method Builder filtered(\Illuminate\Http\Request $request)
 * @method Builder search(string $keywords)
 * @method static  find($id, array $column = ['*'])
 * @method static  findOrFail($id, array $column = ['*'])
 * @method static  updateOrCreate(array $attributes, array $values = [])
 */
class UserDetail extends Model
{
    use HasFactory;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'user_id', 'status', 'position'
    ];

    /**
     * {@inheritdoc}
     */
    protected $hidden = [
        'user_id'
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Define an inverse one-to-one or many relationship with user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)
            ->select(['users.id', 'users.name', 'users.email']);
    }

    /**
     * Scope query for filtered
     *
     * @param  Builder $query
     * @param  \Illuminate\Http\Request $request
     * @return Builder
     */
    public function scopeFiltered(Builder $query, \Illuminate\Http\Request $request): Builder
    {
        if ($request->has('status') && $status = $request->get('status'))
            $query->where('status', $status);

        if ($request->has('search') && $search = $request->get('search'))
            $query->search($search);

        return $query/*->where('user_id', '<>', $request->user('api')->id)*/;
    }

    /**
     * Scope query for search
     *
     * @param  Builder $query
     * @param  string  $keywords
     * @return Builder
     */
    public function scopeSearch(Builder $query, string $keywords): Builder
    {
        return $query
            ->where('status', 'like', "%{$keywords}%")
            ->orWhere('position', 'like', "%{$keywords}%")
            ->orWhereHas('user', function ($subQuery) use ($keywords) {
                return $subQuery
                    ->where('name', 'like', "%{$keywords}%")
                    ->orWhere('email', 'like', "%{$keywords}%");
            });
    }
}
