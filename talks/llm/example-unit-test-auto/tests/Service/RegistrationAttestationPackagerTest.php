<?php
use PHPUnit\Framework\TestCase;
use App\Customer\Service\RegistrationAttestationPackager;
use App\Customer\Entity\Registration;
use ZipArchive;

class RegistrationAttestationPackagerTest extends TestCase
{
    /**
     * @var RegistrationAttestationPackager
     */
    private $attestationPackager;

    /**
     * @var Registration[]
     */
    private $registrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->attestationPackager = new RegistrationAttestationPackager();
        $this->registrations = [
            // generate here some Registration objects
        ];
    }

    public function testWriteArchiveWithAttestationByRegistrations(): void
    {
        $zipName = 'test.zip';
        $zip = $this->attestationPackager->writeArchiveWithAttestationByRegistrations($zipName, $this->registrations);
        $this->assertInstanceOf(ZipArchive::class, $zip);
        $this->assertTrue(file_exists($zipName));
        // Depending on the Registration objects created above, you may want to have further tests on each file that should be in the archive
    }

    public function testGenerateAttestationFileName(): void
    {
        // It's a private method so we would only test it through the public method that's invoking it, testWriteArchiveWithAttestationByRegistrations in this case.
    }
    
    public function testGetArchiveNameBySessions(): void
    {
        // Here the idea is similar, create an array of Session objects and verify that the returned name is correctly generated. Similarly to Registration objects, the creation of Session objects hasn't been implemented in setUp as it depends on your real data.
    }

    public function tearDown(): void
    {
        // You may want to delete the created file
        @unlink('test.zip');
    }
}
?>
