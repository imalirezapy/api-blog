<?php

namespace Modules\Core\Contracts\Controllers;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

interface CrudComponentInterface
{
    /**
     * Display a listing of the resource.
     *
     * @param FormRequest|null $request
     * @return Response
     */
    public function index(FormRequest|null $request): Response;

    /**
     * retrieve a list of resources by providing params
     *
     * @param FormRequest|array $request
     * @return Response
     */
    public function parametricIndex(FormRequest|array $request): Response;

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response;

    /**
     * Update the specified resource in storage.
     *
     * @param FormRequest|array $request
     * @param int $id
     * @param string $successMessage
     * @return Response
     */
    public function update(FormRequest|array $request, int $id, string $successMessage): Response;

    /**
     * Store a newly created resource in storage.
     *
     * @param FormRequest|array $request
     * @param string $successMessage
     * @return Response
     */
    public function store(FormRequest|array $request, string $successMessage): Response;

    public function destroy(int $id, string $successMessage): Response;

    /**
     * Get resource by slug
     *
     * Get a single resource by providing slug
     *
     * @param string $slug
     * @return Response
     */
    public function showBySlug(string $slug): Response;

    /**
     * Get resource by attribute and its value
     *
     * Get a single resource by providing the corresponding attribute and its value
     *
     * @param string $attribute
     * @param $value
     * @return Response
     */
    public function showBy(string $attribute, $value): Response;
}
