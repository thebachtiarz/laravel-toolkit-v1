<?php

namespace TheBachtiarz\Toolkit\Helper\Model;

use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;

/**
 * Model Map Trait
 */
trait ModelMapTrait
{
    use CarbonHelper;

    /**
     * Timestamps information map
     *
     * @return array
     */
    public function getTimestamps(): array
    {
        $result = array_merge(
            $this->createdAt(),
            $this->updatedAt()
        );

        try {
            return array_merge(
                $result,
                $this->deletedAt()
            );
        } catch (\Throwable $th) {
            return $result;
        }
    }

    /**
     * Model id map.
     *
     * @return array
     */
    public function getId(): array
    {
        return ['model_id' => $this->id];
    }

    /**
     * Created at map
     *
     * @return array
     */
    public function createdAt(): array
    {
        return ['created' => self::humanDateTime($this->created_at)];
    }

    /**
     * Updated at map
     *
     * @return array
     */
    public function updatedAt(): array
    {
        return [
            'updated' => self::humanDateTime($this->updated_at),
            'interval' => self::humanIntervalCreateUpdate($this->created_at, $this->updated_at)
        ];
    }

    /**
     * Deleted at map
     *
     * @return array
     */
    public function deletedAt(): array
    {
        return ['deleted' => $this->deleted_at ? self::humanDateTime($this->deleted_at) : ''];
    }
}
