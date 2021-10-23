<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AcademicClass
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $type
 * @property int $academic_grading_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AcademicDepartment[] $academicDepartments
 * @property-read int|null $academic_departments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AcademicGroup[] $academicGroups
 * @property-read int|null $academic_groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AcademicSession[] $academic_sessions
 * @property-read int|null $academic_sessions_count
 * @property-read \App\Models\AcademicGrade $grading
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AcademicSection[] $sections
 * @property-read int|null $sections_count
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClass query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClass whereAcademicGradingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClass whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClass whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClass whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClass whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClass whereUpdatedAt($value)
 */
	class AcademicClass extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicClassDepartment
 *
 * @property int $id
 * @property int $academic_class_id
 * @property int $academic_department_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassDepartment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassDepartment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassDepartment query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassDepartment whereAcademicClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassDepartment whereAcademicDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassDepartment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassDepartment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassDepartment whereUpdatedAt($value)
 */
	class AcademicClassDepartment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicClassGroup
 *
 * @property int $id
 * @property int $academic_class_id
 * @property int $academic_group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassGroup whereAcademicClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassGroup whereAcademicGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassGroup whereUpdatedAt($value)
 */
	class AcademicClassGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicClassSection
 *
 * @property int $id
 * @property int $academic_class_id
 * @property int $academic_section_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSection query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSection whereAcademicClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSection whereAcademicSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSection whereUpdatedAt($value)
 */
	class AcademicClassSection extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicClassSession
 *
 * @property int $id
 * @property int $academic_class_id
 * @property int $academic_session_id
 * @property float|null $admission_fee
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSession whereAcademicClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSession whereAcademicSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSession whereAdmissionFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicClassSession whereId($value)
 */
	class AcademicClassSession extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicData
 *
 * @property int $id
 * @property int $user_id
 * @property int $custom
 * @property int|null $academic_session_id
 * @property int|null $academic_class_id
 * @property int $type
 * @property int|null $academic_group_id
 * @property int|null $academic_section_id
 * @property int|null $academic_department_id
 * @property int|null $academic_year_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicClass|null $class
 * @property-read \App\Models\AcademicDepartment|null $department
 * @property-read mixed $academic_data
 * @property-read mixed $group_department
 * @property-read \App\Models\AcademicGroup|null $group
 * @property-read \App\Models\AcademicSection|null $section
 * @property-read \App\Models\AcademicSession|null $session
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AcademicDataSubject[] $subjects
 * @property-read int|null $subjects_count
 * @property-read \App\User $user
 * @property-read \App\Models\AcademicYear|null $year
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereAcademicClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereAcademicDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereAcademicGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereAcademicSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereAcademicSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicData whereUserId($value)
 */
	class AcademicData extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicDataSubject
 *
 * @property int $id
 * @property int $user_id
 * @property int $academic_data_id
 * @property int $academic_subject_id
 * @property int $isOptional
 * @property float|null $total_gain
 * @property int|null $academic_grade_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicSubject $academicSubject
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject whereAcademicDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject whereAcademicGradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject whereAcademicSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject whereIsOptional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject whereTotalGain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDataSubject whereUserId($value)
 */
	class AcademicDataSubject extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicDepartment
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AcademicYear[] $sections
 * @property-read int|null $sections_count
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartment query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartment whereUpdatedAt($value)
 */
	class AcademicDepartment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicDepartmentYear
 *
 * @property int $id
 * @property int $academic_department_id
 * @property int $academic_year_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartmentYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartmentYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartmentYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartmentYear whereAcademicDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartmentYear whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartmentYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartmentYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicDepartmentYear whereUpdatedAt($value)
 */
	class AcademicDepartmentYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicGrade
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GradePercentage[] $percentages
 * @property-read int|null $percentages_count
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGrade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGrade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGrade query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGrade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGrade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGrade whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGrade whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGrade whereUpdatedAt($value)
 */
	class AcademicGrade extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicGroup
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AcademicSection[] $sections
 * @property-read int|null $sections_count
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroup whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroup whereUpdatedAt($value)
 */
	class AcademicGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicGroupSection
 *
 * @property int $id
 * @property int $academic_group_id
 * @property int $academic_section_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroupSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroupSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroupSection query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroupSection whereAcademicGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroupSection whereAcademicSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroupSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroupSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicGroupSection whereUpdatedAt($value)
 */
	class AcademicGroupSection extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicSection
 *
 * @property int $id
 * @property string $name
 * @property int $seat
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSection query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSection whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSection whereSeat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSection whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSection whereUpdatedAt($value)
 */
	class AcademicSection extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicSession
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property string $start_year
 * @property string $end_year
 * @property string $duration
 * @property int $status
 * @property int $isCurrent
 * @property string $off_day
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AcademicClass[] $academic_classes
 * @property-read int|null $academic_classes_count
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession whereEndYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession whereIsCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession whereOffDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession whereStartYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSession whereUpdatedAt($value)
 */
	class AcademicSession extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicSubject
 *
 * @property int $id
 * @property int $academic_class_id
 * @property int $academic_class_type
 * @property int|null $academic_group_id
 * @property int|null $academic_section_id
 * @property int|null $academic_department_id
 * @property int|null $academic_year_id
 * @property string $name
 * @property string $code
 * @property int $mark_type
 * @property float $theory
 * @property float $practical
 * @property float $full_mark
 * @property int $subject_type
 * @property float $point
 * @property float $total_point
 * @property float $optional_point
 * @property int $religion_type
 * @property int|null $religion_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicClass $academic_class
 * @property-read \App\Models\AcademicDepartment|null $academic_department
 * @property-read \App\Models\AcademicGroup|null $academic_group
 * @property-read \App\Models\AcademicSection|null $academic_section
 * @property-read \App\Models\Religion|null $religion
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereAcademicClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereAcademicClassType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereAcademicDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereAcademicGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereAcademicSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereFullMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereMarkType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereOptionalPoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject wherePractical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereReligionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereReligionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereTheory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereTotalPoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicSubject whereUpdatedAt($value)
 */
	class AcademicSubject extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AcademicYear
 *
 * @property int $id
 * @property string $name
 * @property int $seat
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereSeat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereUpdatedAt($value)
 */
	class AcademicYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Account
 *
 * @property int $id
 * @property string $name
 * @property float $amount
 * @property string|null $bank_account
 * @property string|null $bank_branch
 * @property int $isShow
 * @property int $isActive
 * @property int $created_by
 * @property int $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereBankAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereBankBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedBy($value)
 */
	class Account extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Admission
 *
 * @property int $id
 * @property int $user_id
 * @property int $academic_session_id
 * @property int $academic_data_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicData $academic
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Admission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admission whereAcademicDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admission whereAcademicSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admission whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admission whereUserId($value)
 */
	class Admission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BalanceTransfer
 *
 * @property int $id
 * @property string|null $custom
 * @property int $created_by
 * @property int $from_account_id
 * @property float $amount
 * @property float $from_charge
 * @property float $from_total
 * @property int $to_account_id
 * @property float $to_charge
 * @property float $to_total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TransactionLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\Account $receive_account
 * @property-read \App\Models\Account $sender_account
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer newQuery()
 * @method static \Illuminate\Database\Query\Builder|BalanceTransfer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer query()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereFromAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereFromCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereFromTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereToAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereToCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereToTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceTransfer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|BalanceTransfer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BalanceTransfer withoutTrashed()
 */
	class BalanceTransfer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BasicSetting
 *
 * @property int $id
 * @property string $title
 * @property int|null $level
 * @property string $est
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string|null $sms_api
 * @property string $copy_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BasicSettingTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BasicSettingTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting translated()
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereCopyText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereEst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereSmsApi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSetting withTranslation()
 */
	class BasicSetting extends \Eloquent implements \Astrotomic\Translatable\Contracts\Translatable {}
}

namespace App\Models{
/**
 * App\Models\BasicSettingTranslation
 *
 * @property int $id
 * @property int $basic_setting_id
 * @property string $locale
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSettingTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSettingTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSettingTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSettingTranslation whereBasicSettingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSettingTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSettingTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSettingTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSettingTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasicSettingTranslation whereUpdatedAt($value)
 */
	class BasicSettingTranslation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BillItem
 *
 * @property int $id
 * @property string $title
 * @property string $item_for
 * @property float $default_amount
 * @property int $activated
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereActivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereDefaultAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereItemFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem whereUpdatedAt($value)
 */
	class BillItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BillPackage
 *
 * @property int $id
 * @property int|null $academic_session_id
 * @property int $academic_class_id
 * @property int $academic_class_type
 * @property int|null $academic_group_id
 * @property int|null $academic_department_id
 * @property int|null $academic_year_id
 * @property string|null $bill_type
 * @property array|null $items
 * @property float $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicClass $academic_class
 * @property-read \App\Models\AcademicDepartment|null $academic_department
 * @property-read \App\Models\AcademicGroup|null $academic_group
 * @property-read \App\Models\AcademicSection $academic_section
 * @property-read \App\Models\AcademicSession|null $academic_session
 * @property-read \App\Models\AcademicYear|null $academic_year
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BillStudent[] $billStudents
 * @property-read int|null $bill_students_count
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereAcademicClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereAcademicClassType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereAcademicDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereAcademicGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereAcademicSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereBillType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillPackage whereUpdatedAt($value)
 */
	class BillPackage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BillStudent
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $custom
 * @property int|null $bill_package_id
 * @property float $total
 * @property float $fine
 * @property float $waiver
 * @property float $pay
 * @property float $due
 * @property int $paid_by
 * @property int $receive_by
 * @property int $isAttempt
 * @property int $isPaid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TransactionLog|null $log
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TransactionLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\BillPackage|null $package
 * @property-read \App\User $receiver
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereBillPackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereFine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereIsAttempt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent wherePaidBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent wherePay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereReceiveBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillStudent whereWaiver($value)
 */
	class BillStudent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BloodGroup
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|BloodGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodGroup whereName($value)
 */
	class BloodGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClassPeriod
 *
 * @property int $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $show
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClassPeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassPeriod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassPeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassPeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassPeriod whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassPeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassPeriod whereShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassPeriod whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassPeriod whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassPeriod whereUpdatedAt($value)
 */
	class ClassPeriod extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $website
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereWebsite($value)
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Day
 *
 * @property int $id
 * @property string $name
 * @property string $name_bn
 * @method static \Illuminate\Database\Eloquent\Builder|Day newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Day newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Day query()
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereNameBn($value)
 */
	class Day extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Designation
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Designation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Designation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Designation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Designation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Designation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Designation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Designation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Designation whereUpdatedAt($value)
 */
	class Designation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\District
 *
 * @property int $id
 * @property int $division_id
 * @property string $name
 * @property string $bn_name
 * @property string|null $lat
 * @property string|null $lon
 * @property string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Upazila[] $upazilas
 * @property-read int|null $upazilas_count
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|District whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUrl($value)
 */
	class District extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Division
 *
 * @property int $id
 * @property string $name
 * @property string $bn_name
 * @property string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\District[] $districts
 * @property-read int|null $districts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Division newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Division newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Division query()
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereUrl($value)
 */
	class Division extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EmailSetting
 *
 * @property int $id
 * @property string $sender_name
 * @property string $sender_email
 * @property string $mail_driver
 * @property string|null $smtp_host
 * @property string|null $smtp_port
 * @property string|null $smtp_username
 * @property string|null $smtp_password
 * @property string|null $smtp_enc
 * @property mixed|null $email_template
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereEmailTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereMailDriver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereSenderEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereSenderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereSmtpEnc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereSmtpHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereSmtpPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereSmtpPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereSmtpUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSetting whereUpdatedAt($value)
 */
	class EmailSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Expense
 *
 * @property int $id
 * @property string $custom
 * @property float $total
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ExpenseItems[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TransactionLog[] $logs
 * @property-read int|null $logs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
 * @method static \Illuminate\Database\Query\Builder|Expense onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Expense withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Expense withoutTrashed()
 */
	class Expense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ExpenseItems
 *
 * @property int $id
 * @property int $expense_id
 * @property int $bill_item_id
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BillItem $item
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItems whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItems whereBillItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItems whereExpenseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseItems whereUpdatedAt($value)
 */
	class ExpenseItems extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GradePercentage
 *
 * @property int $id
 * @property int $academic_grade_id
 * @property string $name
 * @property int $min_percentage
 * @property int $max_percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GradePercentage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GradePercentage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GradePercentage query()
 * @method static \Illuminate\Database\Eloquent\Builder|GradePercentage whereAcademicGradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradePercentage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradePercentage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradePercentage whereMaxPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradePercentage whereMinPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradePercentage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradePercentage whereUpdatedAt($value)
 */
	class GradePercentage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ParentUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $parent_id
 * @property int $info_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $guardian
 * @property-read \App\Models\UserParent $guardianInformation
 * @method static \Illuminate\Database\Eloquent\Builder|ParentUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentUser whereInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentUser whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentUser whereUserId($value)
 */
	class ParentUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Religion
 *
 * @property int $id
 * @property string $name
 * @property string $name_bn
 * @method static \Illuminate\Database\Eloquent\Builder|Religion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Religion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Religion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Religion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Religion whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Religion whereNameBn($value)
 */
	class Religion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Salary
 *
 * @property int $id
 * @property string $title
 * @property int|null $role_id
 * @property float $total
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TransactionLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Spatie\Permission\Models\Role|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalaryLog[] $salaries
 * @property-read int|null $salaries_count
 * @method static \Illuminate\Database\Eloquent\Builder|Salary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Salary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Salary query()
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereUpdatedAt($value)
 */
	class Salary extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalaryLog
 *
 * @property int $id
 * @property string $custom
 * @property int $salary_id
 * @property int $user_id
 * @property int $salary_scale_id
 * @property int $account_id
 * @property float $amount
 * @property int $is_attempt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account $account
 * @property-read \App\Models\SalaryScale $scale
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog whereCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog whereIsAttempt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog whereSalaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog whereSalaryScaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryLog whereUserId($value)
 */
	class SalaryLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalaryScale
 *
 * @property int $id
 * @property string $title
 * @property float $amount
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalaryLog[] $salaries
 * @property-read int|null $salaries_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserSalaryScale[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryScale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryScale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryScale query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryScale whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryScale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryScale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryScale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryScale whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryScale whereUpdatedAt($value)
 */
	class SalaryScale extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $username
 * @property string $phone
 * @property string $dob
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUsername($value)
 */
	class Student extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SubjectAssign
 *
 * @property int $id
 * @property string|null $custom
 * @property int $session_id
 * @property int $academic_class_id
 * @property int $type
 * @property int|null $academic_section_id
 * @property int|null $academic_group_id
 * @property int|null $academic_group_section_id
 * @property int|null $academic_department_id
 * @property int|null $academic_year_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicClass $academicClass
 * @property-read \App\Models\AcademicSession $academicSession
 * @property-read \App\Models\AcademicDepartment|null $department
 * @property-read \App\Models\AcademicGroup|null $group
 * @property-read \App\Models\AcademicSection|null $groupSection
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubjectAssignList[] $lists
 * @property-read int|null $lists_count
 * @property-read \App\Models\AcademicSection|null $section
 * @property-read \App\Models\AcademicYear|null $year
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereAcademicClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereAcademicDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereAcademicGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereAcademicGroupSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereAcademicSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssign whereUpdatedAt($value)
 */
	class SubjectAssign extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SubjectAssignList
 *
 * @property int $id
 * @property int $subject_assign_id
 * @property int $academic_subject_id
 * @property int $day_id
 * @property int|null $teacher_id
 * @property int|null $period_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicSubject $academicSubject
 * @property-read \App\Models\Day $day
 * @property-read \App\Models\ClassPeriod|null $period
 * @property-read \App\User|null $teacher
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssignList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssignList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssignList query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssignList whereAcademicSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssignList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssignList whereDayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssignList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssignList wherePeriodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssignList whereSubjectAssignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssignList whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectAssignList whereUpdatedAt($value)
 */
	class SubjectAssignList extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Teacher
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $code
 * @property int $type
 * @property int|null $academic_group_id
 * @property int|null $academic_department_id
 * @property int $designation_id
 * @property int $religion_id
 * @property int $salary_scale_id
 * @property string $blood
 * @property string $join_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicDepartment|null $academicDepartment
 * @property-read \App\Models\AcademicGroup|null $academicGroup
 * @property-read \App\Models\Designation $designation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TeacherEducation[] $educations
 * @property-read int|null $educations_count
 * @property-read \App\Models\SalaryScale $salaryScale
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher query()
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereAcademicDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereAcademicGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereBlood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereDesignationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereJoinDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereReligionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereSalaryScaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereUserId($value)
 */
	class Teacher extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TeacherEducation
 *
 * @property int $id
 * @property int $teacher_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherEducation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherEducation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherEducation query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherEducation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherEducation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherEducation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherEducation whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherEducation whereUpdatedAt($value)
 */
	class TeacherEducation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TransactionLog
 *
 * @property int $id
 * @property int $user_id
 * @property string $logable_type
 * @property int $logable_id
 * @property string $reason
 * @property int $account_id
 * @property float $before_amount
 * @property float $amount
 * @property int $type
 * @property float $after_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $logable
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog newQuery()
 * @method static \Illuminate\Database\Query\Builder|TransactionLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereAfterAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereBeforeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereLogableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereLogableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|TransactionLog withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TransactionLog withoutTrashed()
 */
	class TransactionLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Upazila
 *
 * @property int $id
 * @property int $district_id
 * @property string $name
 * @property string $bn_name
 * @property string $url
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila query()
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereUrl($value)
 */
	class Upazila extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserAddress
 *
 * @property int $id
 * @property int $user_id
 * @property int $division_id
 * @property int $district_id
 * @property int $upazila_id
 * @property string $union_name
 * @property string $post_office
 * @property string $village
 * @property int $address_type
 * @property int|null $present_division_id
 * @property int|null $present_district_id
 * @property int|null $present_upazila_id
 * @property string|null $present_union_name
 * @property string|null $present_post_office
 * @property string|null $present_village
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\District $district
 * @property-read \App\Models\Division $division
 * @property-read \App\Models\District|null $presentDistrict
 * @property-read \App\Models\Division|null $presentDivision
 * @property-read \App\Models\Upazila|null $presentUpazila
 * @property-read \App\Models\Upazila $upazila
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereAddressType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePostOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePresentDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePresentDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePresentPostOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePresentUnionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePresentUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePresentVillage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUnionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereVillage($value)
 */
	class UserAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserDocument
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDocument wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDocument whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDocument whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDocument whereUserId($value)
 */
	class UserDocument extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserFamilyInfo
 *
 * @property int $id
 * @property int $user_id
 * @property string $total_member
 * @property string $earnable_member
 * @property string $yearly_earn
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserFamilyInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFamilyInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFamilyInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFamilyInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFamilyInfo whereEarnableMember($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFamilyInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFamilyInfo whereTotalMember($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFamilyInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFamilyInfo whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFamilyInfo whereYearlyEarn($value)
 */
	class UserFamilyInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserInformation
 *
 * @property int $id
 * @property int $user_id
 * @property string $name_bn
 * @property string $nid
 * @property string $dob
 * @property string $language
 * @property string|null $nationality
 * @property string $gender
 * @property int $religion_id
 * @property string $blood
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Religion $religion
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereBlood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereNameBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereNid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereReligionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInformation whereUserId($value)
 */
	class UserInformation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserParent
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $relation
 * @property string $name
 * @property string $name_bn
 * @property string $nid
 * @property string $image
 * @property string $occupation
 * @property string $phone
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent whereNameBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent whereNid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent whereRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParent whereUserId($value)
 */
	class UserParent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserPreviousInstitute
 *
 * @property int $id
 * @property int $user_id
 * @property string $old_institute_name
 * @property string $old_institute_address
 * @property string $old_institute_class
 * @property string $old_institute_roll
 * @property string|null $old_institute_group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute whereOldInstituteAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute whereOldInstituteClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute whereOldInstituteGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute whereOldInstituteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute whereOldInstituteRoll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPreviousInstitute whereUserId($value)
 */
	class UserPreviousInstitute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserSalaryScale
 *
 * @property int $id
 * @property int $user_id
 * @property int $salary_scale_id
 * @property int $isActive
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SalaryScale $salary_scale
 * @method static \Illuminate\Database\Eloquent\Builder|UserSalaryScale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSalaryScale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSalaryScale query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSalaryScale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSalaryScale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSalaryScale whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSalaryScale whereSalaryScaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSalaryScale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSalaryScale whereUserId($value)
 */
	class UserSalaryScale extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $custom
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $phone
 * @property string $password
 * @property string|null $bio
 * @property string $photo
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserAddress|null $address
 * @property-read \App\Models\Admission|null $admission
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ParentUser[] $childs
 * @property-read int|null $childs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserDocument[] $documents
 * @property-read int|null $documents_count
 * @property-read \App\Models\UserFamilyInfo|null $familyInfo
 * @property-read \App\Models\ParentUser|null $guardian
 * @property-read \App\Models\UserInformation|null $information
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserParent[] $parents
 * @property-read int|null $parents_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\UserPreviousInstitute|null $previousInstitute
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\UserSalaryScale $salary
 * @property-read \App\Models\Teacher|null $teacher
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

