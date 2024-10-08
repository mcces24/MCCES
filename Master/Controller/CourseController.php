<?php
class CourseController extends Course {
    public function getCourse($params = array()) {
        try {
            if (!empty($params)) {
                if (isset($params['course_id'])) {
                    $course_id = $params['course_id'];
                    $condition = [
                        'WHERE' => "course_id = $course_id"
                    ];
                } else {
                    $condition = [];
                }
            } else {
                $condition = [];
            }
            
            $course = $this->read($condition);
            if ($course === false) {
                throw new Exception("Failed to fetch active academic year");
            }
    
            $courses = [];
            while ($row = $course->fetch(PDO::FETCH_ASSOC)) {
                $courses[] = $row;
            }
    
            return $courses;
        } catch (PDOException $e) {
            // Handle PDOException (database connection issues, etc.)
            echo "PDOException in getActiveAcademicYear(): " . $e->getMessage();
            return false; // or handle the error in another way
        } catch (Exception $e) {
            // Handle other exceptions
            echo "Exception in getActiveAcademicYear(): " . $e->getMessage();
            return false; // or handle the error in another way
        }
    }

    // public function isStudentLogin() {
    //     $users = $this->read();
    //     $userArray = [];

    //     while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
    //         $userItem = [
    //             'Id' => $row['Id'],
    //             'email' => $row['email']
    //         ];
    //         array_push($userArray, $userItem);
    //     }

    //     return $userArray;
    // }
}