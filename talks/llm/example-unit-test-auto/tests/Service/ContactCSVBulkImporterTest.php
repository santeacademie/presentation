<?php

namespace Tests\Customer\Service;

use App\Core\PhoneFormatter\PhoneFormatter;
use App\Customer\Entity\Contact;
use App\Customer\Entity\Organization;
use App\Customer\Repository\OrganizationRepository;
use App\Customer\Service\ContactCSVBulkImporter;
use App\External\Entity\Job;
use App\External\Repository\JobRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ContactCSVBulkImporterTest extends TestCase
{
    private ContactCSVBulkImporter $csvBulkImporter;

    protected function setUp(): void
    {
        $jobRepository = $this->createMock(JobRepository::class);
        $organizationRepository = $this->createMock(OrganizationRepository::class);
        $phoneFormatter = $this->createMock(PhoneFormatter::class);

        $this->csvBulkImporter = new ContactCSVBulkImporter($jobRepository, $organizationRepository, $phoneFormatter);
    }

    public function testGetContactsFromCSV()
    {
        $csvContact = "email;gender;firstname;lastname;other_lastname;birthdate;job;practicer_type;phone;organization_id\n
        test@test.com;M;John;Doe;;1999-02-11;JOB01;1;+12345678901;1";

        $contacts = $this->csvBulkImporter->getContactsFromCSV($csvContact);
        $this->assertCount(1, $contacts);
        $this->assertInstanceOf(Contact::class, $contacts[0]);
    }

    public function testGetContactFromArray()
    {
        $id = "id";
        $email = "test@test.com";
        $gender = "M";
        $firstname = "John";
        $lastname = "Doe";
        $otherLastname = "Other";
        $birthdate = "1990-01-01";
        $phone = "+1234567890";
        $job = "JOB01";
        $practicerType = "1";

        $contactArray = [$id, $email, $gender, $firstname, $lastname, $otherLastname, $birthdate, $job, $practicerType, $phone];

        $contact = $this->csvBulkImporter->getContactFromArray($contactArray);

        $this->assertInstanceOf(Contact::class, $contact);
    }
}

?>
