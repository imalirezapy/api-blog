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
    public function index(FormRequest|null $request = null): Response;

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
     * @param string $method
     * @return Response
     */
    public function show(int $id, string $method = 'byId'): Response;

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
     * @param string $method
     * @return Response
     */
    public function showBySlug(string $slug, string $method = 'bySlug'): Response;

    /**
     * Get resource by attribute and its value
     *
     * Get a single resource by providing the corresponding attribute and its value
     *
     * @param string $attribute
     * @param string $method
     * @param $value
     * @return Response
     */
    public function showBy(string $attribute, $value, string $method = 'findBy'): Response;
}
