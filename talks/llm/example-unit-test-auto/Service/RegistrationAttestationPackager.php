<?php

namespace App\Customer\Service;

use App\Catalog\Entity\Session;
use App\Customer\Asset\DownloadAttestationCfpAsset;
use App\Customer\Asset\RegistrationAttestationCfpAsset;
use App\Customer\Entity\Registration;
use Imagick;
use ImagickException;
use Santeacademie\SuperUploaderBundle\Asset\Variant\PdfVariant;
use ZipArchive;

abstract class RegistrationAttestationPackager
{
    /**
     * @param string $zipName
     * @param Registration[] $registrations
     * @return ZipArchive
     * @throws ImagickException
     */
    public static function writeArchiveWithAttestationByRegistrations(string $zipName, array $registrations): ZipArchive
    {
        $zip = new ZipArchive();

        if ($zip->open($zipName, ZipArchive::CREATE| ZipArchive::OVERWRITE) === true) {
            foreach ($registrations as $registration) {
                $filename = self::generateAttestationFileName($registration);

                $variantFile = $registration->registrationAttestationCfp->getVariant(RegistrationAttestationCfpAsset::VARIANT_DOCUMENT_PDF)?->getVariantFile();

                //                if (is_null($variantFile)) {
                //                    $variantFile = $registration->registrationAttestationCfp->getVariant(RegistrationAttestationCfpAsset::VARIANT_DOCUMENT_ORIGINAL)?->getVariantFile();
                //
                //                    if (
                //                        $variantFile->guessExtension() !== RegistrationAttestationCfpAsset::VARIANT_DOCUMENT_PDF_EXTENSION
                //                        || $variantFile->getSize() > RegistrationAttestationCfpAsset::VARIANT_DOCUMENT_PDF_SIZE_LIMIT
                //                    ) {
                //                        $imagick = new Imagick($variantFile->publicUrl());
                //
                //                        $imagick->setImageFormat(RegistrationAttestationCfpAsset::VARIANT_DOCUMENT_PDF_EXTENSION);
                //                        $imagick->writeImage($variantFile->getPathname());
                //                    }
                //                }

                $filePath = $variantFile?->publicUrl();
                if (file_exists($filePath)) {
                    $zip->addFromString($filename, file_get_contents($filePath));
                }
            }

            $zip->close();
        }

        return $zip;
    }

    private static function generateAttestationFileName(Registration $registration): string
    {
        $contact = $registration->getContact();
        return sprintf(
            'attestation-%s%s-%s-%s.pdf',
            $contact?->getLastname(),
            !empty(trim(($contact?->getOtherLastname()))) ? '-'.$contact?->getOtherLastname() : '',
            $contact?->getFirstname(),
            $registration->getId()
        );
    }

    /**
     * @param Session[] $sessions
     * @return string
     */
    public static function getArchiveNameBySessions(array $sessions): string
    {
        return 'attestations_' . implode('_', array_map(static fn (Session $s) => $s->getCode(), $sessions)) . '.zip';
    }
}
