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
 * App\Models\AgentPatient
 *
 * @property int $id
 * @property string $name
 * @property string|null $gender
 * @property string|null $date_of_birth
 * @property string|null $phone
 * @property string|null $other_phone
 * @property int|null $commune_id
 * @property string|null $parcel_number
 * @property string|null $quartier
 * @property string|null $street
 * @property int|null $agent_service_id
 * @property int|null $patient_type_id
 * @property int|null $form_patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Commune|null $commune
 * @property-read \App\Models\FormPatient|null $formPatient
 * @property-read \App\Models\AgentService|null $service
 * @property-read \App\Models\PatientType|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient query()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereAgentServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereCommuneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereFormPatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereOtherPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereParcelNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient wherePatientTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereQuartier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentPatient whereUpdatedAt($value)
 */
	class AgentPatient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AgentService
 *
 * @property int $id
 * @property string $name
 * @property int $hospital_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Hospital $hospital
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AgentPatient> $patients
 * @property-read int|null $patients_count
 * @method static \Illuminate\Database\Eloquent\Builder|AgentService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentService query()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentService whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentService whereUpdatedAt($value)
 */
	class AgentService extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Branch
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property int $hospital_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FormPatient> $formPatients
 * @property-read int|null $form_patients_count
 * @property-read \App\Models\Hospital $hospital
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereUpdatedAt($value)
 */
	class Branch extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Commune
 *
 * @property int $id
 * @property string $name
 * @property int|null $hospital_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AgentPatient> $agentPatients
 * @property-read int|null $agent_patients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PatientPrivate> $patientPrivates
 * @property-read int|null $patient_privates_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PatientSubscribe> $patientSubscribers
 * @property-read int|null $patient_subscribers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Commune newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commune newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commune query()
 * @method static \Illuminate\Database\Eloquent\Builder|Commune whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commune whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commune whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commune whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commune whereUpdatedAt($value)
 */
	class Commune extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property int $subscription_id
 * @property int $hospital_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PatientSubscribe> $patientSubscribers
 * @property-read int|null $patient_subscribers_count
 * @property-read \App\Models\Subscription $subscription
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Currency
 *
 * @property int $id
 * @property string $name
 * @property int $hospital_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FormPatient
 *
 * @property int $id
 * @property string $number
 * @property int $hospital_id
 * @property int $branch_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Branch $branch
 * @property-read \App\Models\Hospital $hospital
 * @property-read \App\Models\PatientPrivate|null $patientPrivate
 * @property-read \App\Models\PatientSubscribe|null $patientSubscriber
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|FormPatient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormPatient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormPatient query()
 * @method static \Illuminate\Database\Eloquent\Builder|FormPatient whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormPatient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormPatient whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormPatient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormPatient whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormPatient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormPatient whereUserId($value)
 */
	class FormPatient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Hospital
 *
 * @property int $id
 * @property string $name
 * @property string|null $logo
 * @property string|null $email
 * @property string|null $phone
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AgentPatient> $agentPatients
 * @property-read int|null $agent_patients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PatientPrivate> $patientPrivates
 * @property-read int|null $patient_privates_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PatientSubscribe> $patientSubscribers
 * @property-read int|null $patient_subscribers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Hospital newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hospital newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hospital query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hospital whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hospital whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hospital whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hospital whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hospital whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hospital wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hospital whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hospital whereUpdatedAt($value)
 */
	class Hospital extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PatientPrivate
 *
 * @property int $id
 * @property string $name
 * @property string|null $gender
 * @property string|null $date_of_birth
 * @property string|null $phone
 * @property string|null $other_phone
 * @property int|null $commune_id
 * @property string|null $parcel_number
 * @property string|null $quartier
 * @property string|null $street
 * @property int|null $form_patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Commune|null $commune
 * @property-read \App\Models\FormPatient|null $formPatient
 * @property-read \App\Models\PatientType|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereCommuneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereFormPatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereOtherPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereParcelNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereQuartier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereUpdatedAt($value)
 */
	class PatientPrivate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PatientSubscribe
 *
 * @property int $id
 * @property string $registration_number
 * @property string $name
 * @property string|null $gender
 * @property string|null $date_of_birth
 * @property string|null $phone
 * @property string|null $other_phone
 * @property int|null $commune_id
 * @property string|null $parcel_number
 * @property string|null $quartier
 * @property string|null $street
 * @property int|null $patient_type_id
 * @property int|null $company_id
 * @property int|null $form_patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Commune|null $commune
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\FormPatient|null $formPatient
 * @property-read \App\Models\PatientType|null $patientType
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereCommuneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereFormPatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereOtherPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereParcelNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe wherePatientTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereQuartier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereRegistrationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientSubscribe whereUpdatedAt($value)
 */
	class PatientSubscribe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PatientType
 *
 * @property int $id
 * @property string $name
 * @property int|null $hospital_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AgentPatient> $agentPatients
 * @property-read int|null $agent_patients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PatientPrivate> $patientPrivates
 * @property-read int|null $patient_privates_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PatientSubscribe> $patientSubscribers
 * @property-read int|null $patient_subscribers_count
 * @method static \Illuminate\Database\Eloquent\Builder|PatientType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientType whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientType whereUpdatedAt($value)
 */
	class PatientType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Rate
 *
 * @property int $id
 * @property int $amount
 * @property int $status
 * @property int $hospital_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereUpdatedAt($value)
 */
	class Rate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property int|null $hospital_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property string $name
 * @property int $amount
 * @property int $familly_quota
 * @property string $status
 * @property int $hospital_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read int|null $companies_count
 * @property-read \App\Models\Hospital $hospital
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereFamillyQuota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUpdatedAt($value)
 */
	class Subscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $password
 * @property int|null $hospital_id
 * @property int|null $branch_id
 * @property int|null $role_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Branch|null $branch
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FormPatient> $forms
 * @property-read int|null $forms_count
 * @property-read \App\Models\Hospital|null $hospital
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

