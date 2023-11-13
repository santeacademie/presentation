<?php

namespace App\Customer\Service;

use App\Core\PhoneFormatter\PhoneFormatter;
use App\Customer\Entity\Contact;
use App\Customer\Entity\Organization;
use App\Customer\Repository\OrganizationRepository;
use App\External\Entity\Job;
use App\External\Repository\JobRepository;
use Santeacademie\BusinessLogic\Customer\Select\SelectContactGender;
use Santeacademie\BusinessLogic\Customer\Select\SelectContactPracticerType;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ContactCSVBulkImporter
{
    public function __construct(
        private JobRepository          $jobRepository,
        private OrganizationRepository $organizationRepository,
        private PhoneFormatter         $phoneFormatter
    ) {
    }

    /**
     * @return Contact[]
     */
    public function getContactsFromCSV(string $csv): array
    {
        $encoder = new CsvEncoder();

        $csv = preg_replace('/\s*($|\n)/', '\1', $csv);

        $rawContacts = $encoder->decode($csv, 'array', [CsvEncoder::DELIMITER_KEY => ';']);

        $contacts = [];

        $rawDefaultContact = [
            'gender' => null,
            'other_lastname' => null,
            'birthdate' => null,
            'job' => null,
            'practicer_type' => null,
            'phone' => null,
            'organization_id' => null,
        ];

        foreach ($rawContacts as $rawContact) {
            $rawContact = array_merge($rawDefaultContact, $rawContact);
            $contacts[] = $this->getContactFromArray($rawContact);
        }

        return $contacts;
    }

    /**
     * @param array<string|int|bool|null> $dataContact
     */
    public function getContactFromArray(array $dataContact): Contact
    {
        $contact = new Contact();

        $contact->setEmail(trim($dataContact['email']));

        $raw_gender = $dataContact['gender'];
        $contact->setGender(
            in_array($raw_gender, SelectContactGender::keys()) ? $raw_gender : null
        );

        $contact->setFirstname($dataContact['firstname'] ?? null);
        $contact->setLastname($dataContact['lastname'] ?? null);
        $contact->setOtherLastname($dataContact['other_lastname'] ?? null);

        $birthdate = \DateTime::createFromFormat('Y-m-d', $dataContact['birthdate']);
        $contact->setBirthdate($birthdate instanceof \DateTimeInterface ? $birthdate : null);

        if (!empty($dataContact['job'])) {
            /** @var Job $job */
            $job = $this->jobRepository->findOneBy(['code' => $dataContact['job']]);
            $contact->setJob($job);
        }

        $rawPracticerType = $dataContact['practicer_type'];
        $contact->setPracticerType(
            in_array($rawPracticerType, SelectContactPracticerType::keys()) ? $rawPracticerType : null
        );

        try {
            $this->phoneFormatter->format(entity: $contact, tryPhone: $dataContact['phone']);
        } catch (\Exception $e) {
            $contact->setPhonePrefix(
                sprintf(
                    '+%s',
                    $this->phoneFormatter
                        ->getPhoneNumberUtil()
                        ->getCountryCodeForRegion(PhoneFormatter::DEFAULT_REGION)
                )
            );
            $contact->setPhone($dataContact['phone']);
        }

        if (!empty($dataContact['organization_id'])) {
            /** @var Organization $organization */
            $organization = $this->organizationRepository->findOneBy(['id' => $dataContact['organization_id']]);
            $contact->setOrganization($organization);
        }

        return $contact;
    }
}
