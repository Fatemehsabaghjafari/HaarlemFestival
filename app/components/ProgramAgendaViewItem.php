<?php

class ProgramAgendaViewItem {
    public $days = array();

    public function __construct($personalProgram) {
        $programDates = array_keys($personalProgram);

        for ($d = 0; $d < count($personalProgram); $d++) {
            $day = array();
            $day['date'] = $programDates[$d];
            $day['events'] = array();
            $events = $personalProgram[$day['date']];

            for ($i = 0; $i < count($events); $i++) {
                $conflictingIndex = null;
                for ($j = 0; $j < count($day['events']); $j++) 
                {
                    if ($this->eventsConflict($events[$i], $day['events'][$j][0])) {
                        $conflictingIndex = $j;
                        break;
                    }
                }

                if ($conflictingIndex !== null) {
                    $day['events'][$conflictingIndex][] = $events[$i];
                } else {
                    $day['events'][] = array($events[$i]);
                }
            }

            $this->days[] = $day;
        }
        // print_r($this->days);
        // print("<pre>".print_r($this->days,true)."</pre>");
    }
    
    private function eventsConflict($event1, $event2) {
        $event1StartTime = new DateTime($event1['time']);
        $event2StartTime = new DateTime($event2['time']);
        $event1DurationMinutes = floatval($event1['duration']) * 60;
        $event2DurationMinutes = floatval($event2['duration']) * 60;
        $event1EndTime = new DateTime($event1['time']);
        $event2EndTime = new DateTime($event2['time']);
        $event1EndTime->modify("+$event1DurationMinutes minutes");
        $event2EndTime->modify("+$event2DurationMinutes minutes");

        if (($event1StartTime >= $event2StartTime && $event1StartTime < $event2EndTime) ||
            ($event2StartTime >= $event1StartTime && $event2StartTime < $event1EndTime)) {
            return true;
        }

        return false;
    }
    

    public function render() {
        $html = '';
        for ($i = 0; $i < count($this->days); $i++) {
            $totalHeight = 0;

            $date = $this->days[$i]['date'];
            $dayOfWeek = date('l', strtotime($date));
            $formattedDate = date('d F', strtotime($date));
            $events = $this->days[$i]['events'];

            $html .= 
            '
            <div class="day">
                <div class="date">' . $formattedDate . '<span>' . $dayOfWeek . '</span></div>
            ';


            for ($j = 0; $j < count($events); $j++) {
                $column = '<div class="columns">';
                for ($k = 0; $k < count($events[$j]); $k++) {
                    $data = $events[$j][$k];
                    $startTime = strtotime("10:00");
                    $time = strtotime($data['time']);
                    $duration = $data['duration'];
                    $hourDifference = ($time - $startTime) / 3600;
                    $height = $duration * 96;
                    $pixels_to_add = 26 + ($hourDifference * 96) - $totalHeight;
                    $image = htmlspecialchars($data['image']);
                    $column .= 
                        "<div class='event' style='background-image: url($image); margin-top:{$pixels_to_add}px; height:{$height}px'></div>";
                    
                }
                $totalHeight += $height + $pixels_to_add;

                $column .= '</div>';
                $html .= $column;
            }

            $html .= '</div>';
        }
        
        return $html;
    }
}