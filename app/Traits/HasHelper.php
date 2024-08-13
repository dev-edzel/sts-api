<?php

namespace App\Traits;

use Illuminate\Http\Resources\MissingValue;

trait HasHelper
{
    public function relatedRss($rss, $rid, $r)
    {
        if ($rss->resource instanceof MissingValue) {
            return [$rid => $this->getAttribute($rid)];
        } else {
            return [$r => $rss];
        }
    }

    public function parseChanges($ini, $fin, $hidden = [])
    {
        $changes = [];

        foreach ($fin as $key => $val) {
            if (in_array($key, $hidden)) {
                continue;
            }

            $changes[$key] = [
                'initial' => $ini[$key],
                'final' => $val
            ];
        }

        return $changes;
    }

    public function resourceParser($request, $resource, $data = [], $auth = true): array
    {
        $data = array_filter(
            array_merge(
                $data,
                $request->validated() ?: $request->all()
            ),
            fn($val) => !is_null($val)
        );

        $ini = $resource->getAttributes();

        $resource->update($data);

        return $this->parseChanges(
            $ini,
            $resource->getChanges(),
            $resource->getHidden()
        );
    }
}
