```php
<?php

namespace App\Tests\Customer\Service;

use App\Customer\Entity\Registration;
use App\Customer\Service\RegistrationBulkCancellationHelper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Workflow\WorkflowInterface;
use Santeacademie\BusinessLogic\Customer\Select\SelectRegistrationCancellationReason;
use Santeacademie\BusinessLogic\Customer\Select\SelectRegistrationStatusTransition;

class RegistrationBulkCancellationHelperTest extends TestCase
{
    private $workflowInterface;
    private $registrationBulkCancellationHelper;

    protected function setUp(): void
    {
        $this->workflowInterface = $this->createMock(WorkflowInterface::class);
        $this->registrationBulkCancellationHelper = new RegistrationBulkCancellationHelper($this->workflowInterface);
    }

    public function testBulkCancellation(): void
    {
        $registrations = [new Registration(), new Registration()];
        $cancellationReason = SelectRegistrationCancellationReason::$ANY_REASON;

        $this->workflowInterface
            ->expects($this->exactly(count($registrations)))
            ->method('apply')
            ->withConsecutive(
                [$registrations[0], SelectRegistrationStatusTransition::$CANCELLATION],
                [$registrations[1], SelectRegistrationStatusTransition::$CANCELLATION]
            );

        $result = $this->registrationBulkCancellationHelper->bulkCancellation($registrations, $cancellationReason);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertInstanceOf(Registration::class, $result[0]);
        $this->assertInstanceOf(Registration::class, $result[1]);
        $this->assertEquals($cancellationReason, $result[0]->getCancellationReason());
        $this->assertEquals($cancellationReason, $result[1]->getCancellationReason());
    }
}
?>
