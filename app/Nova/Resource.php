<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;

abstract class Resource extends NovaResource
{
    /**
     * Maps Nova sidebar group names to the roles permitted to access them.
     * 'superuser' is always granted access via the before() hook in GroupPolicy
     * and is therefore NOT listed here — it is handled separately below.
     */
    private static function groupRoles(): array
    {
        return [
            'Admin'              => ['superuser', 'admin'],
            'Anatomy'            => ['superuser', 'anatomy_editor'],
            'Physiology'         => ['superuser', 'physiology_editor'],
            'GP/Clinical Skills' => ['superuser', 'gp_editor'],
            'Shared'             => ['superuser', 'shared_editor'],
        ];
    }

    /**
     * Returns true if the authenticated user holds a role that is permitted
     * to access the group this Nova resource belongs to.
     */
    private static function userHasGroupAccess(Request $request): bool
    {
        $user = $request->user();

        if (! $user) {
            return false;
        }

        $group   = static::$group ?? '';
        $allowed = static::groupRoles()[$group] ?? ['superuser'];

        return $user->hasAnyRole($allowed);
    }

    public static function authorizedToViewAny(Request $request): bool
    {
        return static::userHasGroupAccess($request);
    }

    public static function authorizedToCreate(Request $request): bool
    {
        return static::userHasGroupAccess($request);
    }

    public function authorizedToView(Request $request): bool
    {
        return static::userHasGroupAccess($request);
    }

    public function authorizedToUpdate(Request $request): bool
    {
        return static::userHasGroupAccess($request);
    }

    public function authorizedToDelete(Request $request): bool
    {
        return static::userHasGroupAccess($request);
    }

    public function authorizedToReplicate(Request $request): bool
    {
        return static::userHasGroupAccess($request);
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a Scout search query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Scout\Builder  $query
     * @return \Laravel\Scout\Builder
     */
    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a "detail" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function detailQuery(NovaRequest $request, $query)
    {
        return parent::detailQuery($request, $query);
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        return parent::relatableQuery($request, $query);
    }
}
