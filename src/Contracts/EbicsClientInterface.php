<?php

namespace AndrewSvirin\Ebics\Contracts;

use AndrewSvirin\Ebics\Contexts\BTFContext;
use AndrewSvirin\Ebics\Contexts\BTUContext;
use AndrewSvirin\Ebics\Contexts\HVDContext;
use AndrewSvirin\Ebics\Contexts\HVEContext;
use AndrewSvirin\Ebics\Contexts\HVTContext;
use AndrewSvirin\Ebics\Models\DownloadOrderResult;
use AndrewSvirin\Ebics\Models\Http\Response;
use AndrewSvirin\Ebics\Models\InitializationOrderResult;
use AndrewSvirin\Ebics\Models\UploadOrderResult;
use DateTimeInterface;

/**
 * EBICS client representation.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrew Svirin
 */
interface EbicsClientInterface
{
    /**
     * Create user signatures A, E and X on first launch.
     */
    public function createUserSignatures(): void;

    /**
     * Download supported protocol versions for the Bank.
     * @return Response
     */
    public function HEV(): Response;

    /**
     * Make INI request.
     * Send to the bank public signature of signature A00X.
     * Prepare A00X signature for KeyRing.
     * @param DateTimeInterface|null $dateTime current date
     * @return Response
     */
    public function INI(DateTimeInterface $dateTime = null): Response;

    /**
     * Make HIA request.
     * Send to the bank public signatures of authentication (X002) and encryption (E002).
     * Prepare E002 and X002 user signatures for KeyRing.
     * @param DateTimeInterface|null $dateTime current date
     * @return Response
     */
    public function HIA(DateTimeInterface $dateTime = null): Response;

    /**
     * Download the Bank public signatures authentication (X002) and encryption (E002).
     * Prepare E002 and X002 bank signatures for KeyRing.
     * @param DateTimeInterface|null $dateTime current date
     * @return InitializationOrderResult
     */
    public function HPB(DateTimeInterface $dateTime = null): InitializationOrderResult;

    /**
     * Download request files of any BTF structure.
     * @param BTFContext $btfContext
     * @param DateTimeInterface|null $dateTime
     * @param DateTimeInterface|null $startDateTime
     * @param DateTimeInterface|null $endDateTime
     * @return DownloadOrderResult
     */
    public function BTD(
        BTFContext $btfContext,
        DateTimeInterface $dateTime = null,
        DateTimeInterface $startDateTime = null,
        DateTimeInterface $endDateTime = null
    ): DownloadOrderResult;

    /**
     * Upload the files to the bank.
     */
    public function BTU(BTUContext $btuContext, DateTimeInterface $dateTime = null): UploadOrderResult;

    /**
     * Download the bank server parameters.
     * @param DateTimeInterface|null $dateTime
     * @return DownloadOrderResult
     */
    public function HPD(DateTimeInterface $dateTime = null): DownloadOrderResult;

    /**
     * Download customer's customer and subscriber information.
     * @param DateTimeInterface|null $dateTime
     * @return DownloadOrderResult
     */
    public function HKD(DateTimeInterface $dateTime = null): DownloadOrderResult;

    /**
     * Download subscriber's customer and subscriber information.
     * @param DateTimeInterface|null $dateTime
     * @return DownloadOrderResult
     */
    public function HTD(DateTimeInterface $dateTime = null): DownloadOrderResult;

    /**
     * Download transaction status.
     * @param DateTimeInterface|null $dateTime
     * @return DownloadOrderResult
     */
    public function PTK(DateTimeInterface $dateTime = null): DownloadOrderResult;

    /**
     * Download Bank available order types.
     * @param DateTimeInterface|null $dateTime current date
     * @return DownloadOrderResult
     */
    public function HAA(DateTimeInterface $dateTime = null): DownloadOrderResult;

    /**
     * Download the interim transaction report in SWIFT format (MT942).
     * @param DateTimeInterface|null $dateTime current date
     * @param DateTimeInterface|null $startDateTime the start date of requested transactions
     * @param DateTimeInterface|null $endDateTime the end date of requested transactions
     * @return DownloadOrderResult
     */
    public function VMK(
        DateTimeInterface $dateTime = null,
        DateTimeInterface $startDateTime = null,
        DateTimeInterface $endDateTime = null
    ): DownloadOrderResult;

    /**
     * Download the bank account statement.
     * @param DateTimeInterface|null $dateTime
     * @param DateTimeInterface|null $startDateTime the start date of requested transactions
     * @param DateTimeInterface|null $endDateTime the end date of requested transactions
     * @return DownloadOrderResult
     */
    public function STA(
        DateTimeInterface $dateTime = null,
        DateTimeInterface $startDateTime = null,
        DateTimeInterface $endDateTime = null
    ): DownloadOrderResult;

    /**
     * Download the bank account report in Camt.052 format.
     * @param DateTimeInterface|null $dateTime
     * @param DateTimeInterface|null $startDateTime the start date of requested transactions
     * @param DateTimeInterface|null $endDateTime the end date of requested transactions
     * @return DownloadOrderResult
     */
    // @codingStandardsIgnoreStart
    public function C52(
        DateTimeInterface $dateTime = null,
        DateTimeInterface $startDateTime = null,
        DateTimeInterface $endDateTime = null
    ): DownloadOrderResult;
    // @codingStandardsIgnoreEnd

    /**
     * Download the bank account statement in Camt.053 format.
     * @param DateTimeInterface|null $dateTime
     * @param DateTimeInterface|null $startDateTime the start date of requested transactions
     * @param DateTimeInterface|null $endDateTime the end date of requested transactions
     * @return DownloadOrderResult
     */
    // @codingStandardsIgnoreStart
    public function C53(
        DateTimeInterface $dateTime = null,
        DateTimeInterface $startDateTime = null,
        DateTimeInterface $endDateTime = null
    ): DownloadOrderResult;
    // @codingStandardsIgnoreEnd

    /**
     * Download Debit Credit Notification (DTI).
     * @param DateTimeInterface|null $dateTime
     * @param DateTimeInterface|null $startDateTime the start date of requested transactions
     * @param DateTimeInterface|null $endDateTime the end date of requested transactions
     * @return DownloadOrderResult
     */
    // @codingStandardsIgnoreStart
    public function C54(
        DateTimeInterface $dateTime = null,
        DateTimeInterface $startDateTime = null,
        DateTimeInterface $endDateTime = null
    ): DownloadOrderResult;
    // @codingStandardsIgnoreEnd

    /**
     * Download the bank account report in Camt.052 format (i.e Switzerland financial services).
     * @param DateTimeInterface|null $dateTime
     * @param DateTimeInterface|null $startDateTime the start date of requested transactions
     * @param DateTimeInterface|null $endDateTime the end date of requested transactions
     * @return DownloadOrderResult
     */
    // @codingStandardsIgnoreStart
    public function Z52(
        DateTimeInterface $dateTime = null,
        DateTimeInterface $startDateTime = null,
        DateTimeInterface $endDateTime = null
    ): DownloadOrderResult;
    // @codingStandardsIgnoreEnd

    /**
     * Download the bank account statement in Camt.053 format (i.e Switzerland financial services).
     * @param DateTimeInterface|null $dateTime
     * @param DateTimeInterface|null $startDateTime the start date of requested transactions
     * @param DateTimeInterface|null $endDateTime the end date of requested transactions
     * @return DownloadOrderResult
     */
    // @codingStandardsIgnoreStart
    public function Z53(
        DateTimeInterface $dateTime = null,
        DateTimeInterface $startDateTime = null,
        DateTimeInterface $endDateTime = null
    ): DownloadOrderResult;
    // @codingStandardsIgnoreEnd

    /**
     * Download the bank account statement in Camt.054 format (i.e available in Switzerland).
     * @param DateTimeInterface|null $dateTime
     * @param DateTimeInterface|null $startDateTime the start date of requested transactions
     * @param DateTimeInterface|null $endDateTime the end date of requested transactions
     * @return DownloadOrderResult
     */
    // @codingStandardsIgnoreStart
    public function Z54(
        DateTimeInterface $dateTime = null,
        DateTimeInterface $startDateTime = null,
        DateTimeInterface $endDateTime = null
    ): DownloadOrderResult;
    // @codingStandardsIgnoreEnd

    /**
     * Download subscriber's customer and subscriber information.
     * @param string $fileInfo Format of response.
     * @param string $format = 'text' ?? 'xml'
     * @param string $countryCode
     * @param DateTimeInterface|null $dateTime
     * @param DateTimeInterface|null $startDateTime
     * @param DateTimeInterface|null $endDateTime
     * @return DownloadOrderResult
     */
    public function FDL(
        string $fileInfo,
        string $format = 'text',
        string $countryCode = 'FR',
        DateTimeInterface $dateTime = null,
        DateTimeInterface $startDateTime = null,
        DateTimeInterface $endDateTime = null
    ): DownloadOrderResult;

    /**
     * Upload initiation of the credit transfer per Single Euro Payments Area (SEPA)
     * specification set by the European Payment Council or Die Deutsche Kreditwirtschaft (DK (German)).
     * CCT is an upload order type that uses the protocol version H00X.
     * FileFormat pain.001.001.03
     * @param OrderDataInterface $orderData
     * @param DateTimeInterface|null $dateTime
     * @return UploadOrderResult
     */
    public function CCT(OrderDataInterface $orderData, DateTimeInterface $dateTime = null): UploadOrderResult;

    /**
     * Upload initiation of the instant credit transfer per Single Euro Payments Area.
     * @param OrderDataInterface $orderData
     * @param DateTimeInterface|null $dateTime
     * @return UploadOrderResult
     */
    public function CIP(OrderDataInterface $orderData, DateTimeInterface $dateTime = null): UploadOrderResult;

    /**
     * Download List the orders for which the user is authorized as a signatory.
     * @param DateTimeInterface|null $dateTime
     * @return DownloadOrderResult
     */
    public function HVU(DateTimeInterface $dateTime = null): DownloadOrderResult;

    /**
     * Download VEU overview with additional information.
     * @param DateTimeInterface|null $dateTime
     * @return DownloadOrderResult
     */
    public function HVZ(DateTimeInterface $dateTime = null): DownloadOrderResult;

    /**
     * Add a VEU signature for order.
     * @param HVEContext $hveContext
     * @param DateTimeInterface|null $dateTime
     * @return UploadOrderResult
     */
    public function HVE(HVEContext $hveContext, DateTimeInterface $dateTime = null): UploadOrderResult;

    /**
     * Download the state of a VEU order.
     * @param HVDContext $hvdContext
     * @param DateTimeInterface|null $dateTime
     * @return DownloadOrderResult
     */
    public function HVD(HVDContext $hvdContext, DateTimeInterface $dateTime = null): DownloadOrderResult;

    /**
     * Download detailed information about an order from VEU processing for which the user is authorized as a signatory.
     * @param HVTContext $hvtContext
     * @param DateTimeInterface|null $dateTime
     * @return DownloadOrderResult
     */
    public function HVT(HVTContext $hvtContext, DateTimeInterface $dateTime = null): DownloadOrderResult;

    /**
     * Upload initiation credit transfer per Swiss Payments specification set by Six banking services.
     * XE2 is an upload order type that uses the protocol version H00X.
     * FileFormat pain.001.001.03.ch.02
     * @param OrderDataInterface $orderData
     * @param DateTimeInterface|null $dateTime
     * @return UploadOrderResult
     */
    public function XE2(OrderDataInterface $orderData, DateTimeInterface $dateTime = null): UploadOrderResult;

    /**
     * Upload initiation of the direct debit transaction.
     * The CDD order type uses the protocol version H00X.
     * FileFormat pain.008.001.02
     * @param OrderDataInterface $orderData
     * @param DateTimeInterface|null $dateTime
     * @return UploadOrderResult
     */
    public function CDD(OrderDataInterface $orderData, DateTimeInterface $dateTime = null): UploadOrderResult;

    /**
     * Set certificate X509 Generator for French bank.
     * @param X509GeneratorInterface|null $x509Generator
     */
    public function setX509Generator(X509GeneratorInterface $x509Generator = null): void;

    /**
     * Set http client to subset later in the project.
     * @param HttpClientInterface $httpClient
     */
    public function setHttpClient(HttpClientInterface $httpClient): void;
}
