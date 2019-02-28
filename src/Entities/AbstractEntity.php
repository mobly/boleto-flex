<?php

namespace Mobly\Boletoflex\Sdk\Entities;

class AbstractEntity
{
    /**
     * @param bool $withEmpty
     * @return array
     */
    public function toArray($withEmpty = true)
    {
        $properties = get_object_vars($this);

        $data = array();
        foreach ($properties as $property => $value) {
            if ($value instanceof AbstractEntity) {
                $data[$property] = $value->toArray($withEmpty);

                continue;
            }

            if ((is_array($value) && count($value)) || $value instanceof \IteratorAggregate) {
                foreach ($value as $index => $item) {
                    if ($item instanceof AbstractEntity) {
                        $data[$property][$index] = $item->toArray($withEmpty);
                    } else {
                        $data[$property][$index] = $item;
                    }
                }

                continue;
            }

            if ($withEmpty) {
                $data[$property] = $this->$property;
                continue;
            }

            if (($this->$property == 0 && null !== $this->$property) || !empty($this->$property)) {
                $data[$property] = $this->$property;
            }
        }

        return $data;
    }
}
