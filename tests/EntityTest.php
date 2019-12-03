<?php

namespace CrixuAMG\Tests;

use PHPUnit\Framework\TestCase;
use CrixuAMG\Financials\Exact\Connection;

/**
 * Class EntityTest.
 *
 * Tests all entities to ensure entities have no PHP parse errors and have
 * at least the properties we need to use the entity
 */
class EntityTest extends TestCase
{
    public function testAccountEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Account::class);
    }

    public function testAccountClassificationEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\AccountClassification::class);
    }

    public function testAccountInvolvedAccountEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\AccountInvolvedAccount::class);
    }

    public function testAccountItemEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\AccountItem::class);
    }

    public function testAddressEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Address::class);
    }

    public function testBankAccountEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\BankAccount::class);
    }

    public function testBankEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Bank::class);
    }

    public function testBankEntryEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\BankEntry::class);
    }

    public function testBankEntryLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\BankEntryLine::class);
    }

    public function testBudgetEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Budget::class);
    }

    public function testCashEntryEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\CashEntry::class);
    }

    public function testCashEntryLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\CashEntryLine::class);
    }

    public function testContactEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Contact::class);
    }

    public function testCostcenterEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Costcenter::class);
    }

    public function testCostunitEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Costunit::class);
    }

    public function testDirectDebitMandateEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\DirectDebitMandate::class);
    }

    public function testDivisionEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Division::class);
    }

    public function testSystemDivisionEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SystemDivision::class);
    }

    public function testDocumentEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Document::class);
    }

    public function testDocumentAttachmentEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\DocumentAttachment::class);
        $documentAttachment = new \CrixuAMG\Financials\Exact\DocumentAttachment(new Connection());
        $documentAttachment->Url = 'http://www.example.org/index.html?id=123';

        $this->assertSame('http://www.example.org/index.html?id=123&Download=1', $documentAttachment->getDownloadUrl());
    }

    public function testDocumentCategoryEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\DocumentCategory::class);
    }

    public function testDocumentTypeEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\DocumentType::class);
    }

    public function testEmployeeEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Employee::class);
    }

    public function testExchangeRateEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ExchangeRate::class);
    }

    public function testGeneralJournalEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\GeneralJournalEntry::class);
    }

    public function testGeneralJournalEntryLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\GeneralJournalEntryLine::class);
    }

    public function testGLAccountEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\GLAccount::class);
    }

    public function testGLTransactionTypeEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\GLTransactionType::class);
    }

    public function testInvoiceSalesOrdersEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\InvoiceSalesOrder::class);
    }

    public function testItemEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Item::class);
        $item = new \CrixuAMG\Financials\Exact\Item(new Connection());
        $item->PictureUrl = 'http://www.example.org/index.html?id=123';

        $this->assertSame('http://www.example.org/index.html?id=123', $item->getDownloadUrl());
    }

    public function testItemExtraField()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ItemExtraField::class);
    }

    public function testItemGroupEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ItemGroup::class);
    }

    public function testItemWarehouseEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ItemWarehouse::class);
    }

    public function testJournalEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Journal::class);
    }

    public function testLayoutEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Layout::class);
    }

    public function testMailMessageEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\MailMessage::class);
    }

    public function testMailMessageAttachmentEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\MailMessageAttachment::class);
    }

    public function testMeEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Me::class);
    }

    public function testOutstandingInvoicesOverviewEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\OutstandingInvoicesOverview::class);
    }

    public function testPayablesListEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\PayablesList::class);
    }

    public function testPaymentConditionEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\PaymentCondition::class);
    }

    public function testPrintedSalesInvoiceEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\PrintedSalesInvoice::class);
    }

    public function testProfitLossOverviewEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ProfitLossOverview::class);
    }

    public function testPurchaseEntryEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\PurchaseEntry::class);
    }

    public function testPurchaseEntryLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\PurchaseEntryLine::class);
    }

    public function testPurchaseOrderEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\PurchaseOrder::class);
    }

    public function testPurchaseOrderLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\PurchaseOrderLine::class);
    }

    public function testRevenueListEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\RevenueList::class);
    }

    public function testQuotationEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Quotation::class);
    }

    public function testQuotationLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\QuotationLine::class);
    }

    public function testReceivableListEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ReceivableList::class);
    }

    public function testReportingBalanceEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ReportingBalance::class);
    }

    public function testSalesEntryEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SalesEntry::class);
    }

    public function testSalesEntryLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SalesEntryLine::class);
    }

    public function testSalesInvoiceEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SalesInvoice::class);
    }

    public function testSalesInvoiceLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SalesInvoiceLine::class);
    }

    public function testSalesItemPriceEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SalesItemPrice::class);
    }

    public function testSalesOrderEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SalesOrder::class);
    }

    public function testSalesOrderLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SalesOrderLine::class);
    }

    public function testStockPositionEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\StockPosition::class);
    }

    public function testSubscriptionEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Subscription::class);
    }

    public function testSubscriptionLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SubscriptionLine::class);
    }

    public function testSubscriptionTypeEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SubscriptionType::class);
    }

    public function testTransactionEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Transaction::class);
    }

    public function testTransactionLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\TransactionLine::class);
    }

    public function testUnitsEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Units::class);
    }

    public function testVatcodeEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\VatCode::class);
    }

    public function testWebhookSubscriptionEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\WebhookSubscription::class);
    }

    public function testStockCountEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\StockCount::class);
    }

    public function testStockCountLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\StockCountLine::class);
    }

    public function testWarehouseEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Warehouse::class);
    }

    public function testStorageLocationEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\StorageLocation::class);
    }

    public function testGoodsDeliveryEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\GoodsDelivery::class);
    }

    public function testGoodsDeliveryLineEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\GoodsDeliveryLine::class);
    }

    public function testSalesOrderIDEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SalesOrderID::class);
    }

    public function testItemWarehousePlanningDetails()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ItemWarehousePlanningDetails::class);
    }

    public function testSalesShippingMethods()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\SalesShippingMethods::class);
    }

    public function testInvoiceTerm()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\InvoiceTerm::class);
    }

    public function testBillOfMaterialVersion()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\BillOfMaterialVersion::class);
    }

    public function testBillOfMaterialMaterial()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\BillOfMaterialMaterial::class);
    }

    public function testProject()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Project::class);
    }

    public function testProjectWBSByProject()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ProjectWBSByProject::class);
    }

    public function testShopOrder()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ShopOrder::class);
    }

    public function testTimeTransactionEntity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\TimeTransaction::class);
    }

    public function testUser()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\User::class);
    }

    public function testShopOrderMaterialPlan()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ShopOrderMaterialPlan::class);
    }

    public function testShopOrderRoutingStepPlan()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ShopOrderRoutingStepPlan::class);
    }

    public function testOperation()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Operation::class);
    }

    public function testOperationResource()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\OperationResource::class);
    }

    public function testAbsenceRegistration()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\AbsenceRegistration::class);
    }

    public function testAbsenceRegistrationTransaction()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\AbsenceRegistrationTransaction::class);
    }

    public function testDepartment()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Department::class);
    }

    public function testDivisionClass()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\DivisionClass::class);
    }

    public function testDivisionClassName()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\DivisionClassName::class);
    }

    public function testDivisionClassValue()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\DivisionClassValue::class);
    }

    public function testJobGroup()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\JobGroup::class);
    }

    public function testJobTitle()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\JobTitle::class);
    }

    public function testLeaveBuildUpRegistration()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\LeaveBuildUpRegistration::class);
    }

    public function testLeaveRegistration()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\LeaveRegistration::class);
    }

    public function testSchedule()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Schedule::class);
    }

    public function testStockBatchNumber()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\StockBatchNumber::class);
    }

    public function testStockSerialNumber()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\StockSerialNumber::class);
    }

    public function testWarehouseTransferLine()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\WarehouseTransferLine::class);
    }

    public function testWarehouseTransfer()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\WarehouseTransfer::class);
    }

    public function testProductionArea()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ProductionArea::class);
    }

    public function testTimedTimeTransaction()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\TimedTimeTransaction::class);
    }

    public function testWorkcenter()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Workcenter::class);
    }

    public function testCostTransaction()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\CostTransaction::class);
    }

    public function testProjectHourBudget()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ProjectHourBudget::class);
    }

    public function testProjectPlanning()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ProjectPlanning::class);
    }

    public function testProjectPlanningRecurring()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ProjectPlanningRecurring::class);
    }

    public function testProjectRestrictionEmployee()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ProjectRestrictionEmployee::class);
    }

    public function testProjectRestrictionItem()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ProjectRestrictionItem::class);
    }

    public function testProjectRestrictionRebilling()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ProjectRestrictionRebilling::class);
    }

    public function testRecentCost()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\RecentCost::class);
    }

    public function testRecentHour()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\RecentHour::class);
    }

    public function testTimeCorrection()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\TimeCorrection::class);
    }

    public function testEmployment()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Employment::class);
    }

    public function testEmploymentContract()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\EmploymentContract::class);
    }

    public function testActiveEmployment()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ActiveEmployment::class);
    }

    public function testOpportunity()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\Opportunity::class);
    }

    public function testItemWarehouseStorageLocation()
    {
        $this->performEntityTest(\CrixuAMG\Financials\Exact\ItemWarehouseStorageLocation::class);
    }

    protected function performEntityTest($entityName)
    {
        $reflectionClass = new \ReflectionClass($entityName);

        $this->assertTrue($reflectionClass->isInstantiable());
        $this->assertTrue($reflectionClass->hasProperty('fillable'));
        $this->assertTrue($reflectionClass->hasProperty('url'));
        $this->assertEquals('CrixuAMG\Financials\Exact', $reflectionClass->getNamespaceName());
        $this->assertEquals('CrixuAMG\Financials\Exact\Model', $reflectionClass->getParentClass()->getName());
    }
}
