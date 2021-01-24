<?php

namespace App\Contracts;

interface SimpleCrudServiceInterface
{
    /**
     * Revert all resources
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function all(\Illuminate\Http\Request $request);

    /**
     * Revert resource specific by id
     *
     * @param  int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     *
     * @throws \Throwable
     */
    public function show(int $id): ?\Illuminate\Database\Eloquent\Model;

    /**
     * Handle store or update resource
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int|null $id
     * @return \Illuminate\Database\Eloquent\Model|null;
     */
    public function upsert(\Illuminate\Http\Request $request, int $id = null): ?\Illuminate\Database\Eloquent\Model;

    /**
     * Remove resource specific by id
     *
     * @param int $id
     *
     * @throws \Throwable
     * @throws \Exception
     */
    public function destroy(int $id): void;
}
