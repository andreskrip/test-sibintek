<?php

function sumIntervals(array $intervals): int
{
    $intervals = intervalValuesValidation($intervals);
    $intervals = multiarray_unique($intervals);

    // compare all intervals with each other to detect intersections
    foreach ($intervals as &$interval1) {
        foreach ($intervals as $interval2) {
            //if the interval compares with itself - skip the iteration
            if ($interval1 === $interval2) {
                continue;
            }
            //if intersection is found, merge arrays, removing the original and break the loop
            if ($interval1[0] <= $interval2[1] && $interval1[1] >= $interval2[0]) {
                $intervals[] = [
                    min(array_merge($interval1, $interval2)),
                    max(array_merge($interval1, $interval2))
                ];
                unset(
                    $intervals[array_search($interval1, $intervals)],
                    $intervals[array_search($interval2, $intervals)]
                );
                break;
            }
        }
    }
    $result = 0;
    //calculate the sum of the lengths of all intervals
    foreach ($intervals as $interval) {
        $result += $interval[1] - $interval[0];
    }
    return $result;
}

if (!empty($_POST)) {
    $arr = $_POST;
    $result = sumIntervals($arr);
}

// filtering invalid interval values
function intervalValuesValidation(array $intervals): array
{
    foreach ($intervals as $interval) {
        if (
            !(is_numeric($interval[0]) && is_numeric($interval[1])) ||
            ($interval[0] >= $interval[1]) ||
            (count($interval) !== 2)) {
            exit('Incorrect data input');
        }
    }
    return $intervals;
}

// filtering the repeating intervals
function multiarray_unique(array $arr): array
{
    $result = array_map("unserialize", array_unique(array_map("serialize", $arr)));
    foreach ($result as $key => $value) {
        if (is_array($value)) {
            $result[$key] = multiarray_unique($value);
        }
    }
    return $result;
}
