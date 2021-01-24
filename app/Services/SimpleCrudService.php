<?php

namespace App\Services;

use App\Contracts\SimpleCrudServiceInterface;
use App\Models\UserDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SimpleCrudService implements SimpleCrudServiceInterface
{
    /**
     * @var UserDetail
     */
    protected UserDetail $repoUserDetail;

    /**
     * SimpleCrudService constructor.
     *
     * @param UserDetail $repoUserDetail
     * @return void
     */
    public function __construct(UserDetail $repoUserDetail)
    {
        $this->repoUserDetail = $repoUserDetail;
    }

    /**
     * {@inheritdoc}
     */
    public function all(\Illuminate\Http\Request $request)
    {
        $resource = $this->repoUserDetail->filtered($request)->with('user')->paginate();

        return [
            'data' => $resource->items(),
            'pagination' => [
                'current_page' => $resource->currentPage(),
                'first_page_url' => $resource->url(1),
                'from' => $resource->firstItem(),
                'last_page' => $resource->lastPage(),
                'last_page_url' => $resource->url($resource->lastPage()),
                'next_page_url' => $resource->nextPageUrl(),
                'path' => $resource->path(),
                'per_page' => $resource->perPage(),
                'prev_page_url' => $resource->previousPageUrl(),
                'to' => $resource->lastItem(),
                'total' => $resource->total(),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function show(int $id): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->repoUserDetail->with('user')->findOrFail($id);
    }

    /**
     * {@inheritdoc}
     */
    public function upsert(\Illuminate\Http\Request $request, int $id = null): ?\Illuminate\Database\Eloquent\Model
    {
        $attributes = [
            'id'      => $id,
            'user_id' => (int) $request->input('user_id'),
            'status'  => $request->input('status')
        ];

        return $this->repoUserDetail->updateOrCreate(
            $attributes, $request->only($this->repoUserDetail->getFillable())
        );
    }

    /**
     * {@inheritdoc}
     */
    public function destroy(int $id): void
    {
        $this->show($id)->delete();
    }
}
