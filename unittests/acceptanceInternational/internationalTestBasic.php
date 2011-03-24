<?php
/**
 *    This file is part of OXID eShop Community Edition.
 *
 *    OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.oxid-esales.com
 * @package tests
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop CE
 */


require_once 'acceptance/oxidAdditionalSeleniumFunctions.php';

class AcceptanceInternational_internationalTestBasic extends oxidAdditionalSeleniumFunctions
{

    protected function setUp($skipDemoData=false)
    {
        parent::setUp(false);
    }

 // -------------------------- Selenium tests for UTF-8 shop version ---------------------------


    /*
     * creating User
     * @group admin
     * @group create
     */
    public function testCreateUserInternational()
    {
        //Main tab
        $this->loginAdmin("Administer Users", "Users", "btn.new");
        $this->frame("edit");
        $this->clickAndWaitFrame("btn.new", "edit");
        $this->assertEquals("off", $this->getValue("editval[oxuser__oxactive]"));
        $this->check("editval[oxuser__oxactive]");
        $this->type("editval[oxuser__oxusername]", "birute01@nfq.lt");
        $this->type("editval[oxuser__oxcustnr]", "20");
        $this->select("editval[oxuser__oxsal]", "label=Mr");
        $this->type("editval[oxuser__oxfname]", "Name_šųößлы");
        $this->type("editval[oxuser__oxlname]", "Surname_šųößлы");
        $this->type("editval[oxuser__oxcompany]", "company_šųößлы");
        $this->type("editval[oxuser__oxstreet]", "street_šųößлы");
        $this->type("editval[oxuser__oxstreetnr]", "1");
        $this->type("editval[oxuser__oxzip]", "3000");
        $this->type("editval[oxuser__oxcity]", "City_šųößлы");
        $this->type("editval[oxuser__oxustid]", "111222");
        $this->type("editval[oxuser__oxaddinfo]", "additional info_šųößлы");
        $this->select("editval[oxuser__oxcountryid]", "label=Germany");
        $this->type("editval[oxuser__oxfon]", "111222333");
        $this->type("editval[oxuser__oxfax]", "222333444");
        $this->type("editval[oxuser__oxbirthdate][day]", "01");
        $this->type("editval[oxuser__oxbirthdate][month]", "12");
        $this->type("editval[oxuser__oxbirthdate][year]", "1980");
        $this->clickAndWaitFrame("save", "list");
        $this->assertEquals("on", $this->getValue("editval[oxuser__oxactive]"));
        $this->assertEquals("Customer", $this->getSelectedLabel("editval[oxuser__oxrights]"));
        $this->assertEquals("birute01@nfq.lt", $this->getValue("editval[oxuser__oxusername]"));
        $this->assertEquals("20", $this->getValue("editval[oxuser__oxcustnr]"));
        $this->assertEquals("Mr", $this->getSelectedLabel("editval[oxuser__oxsal]"));
        $this->assertEquals("Name_šųößлы", $this->getValue("editval[oxuser__oxfname]"));
        $this->assertEquals("Surname_šųößлы", $this->getValue("editval[oxuser__oxlname]"));
        $this->assertEquals("company_šųößлы", $this->getValue("editval[oxuser__oxcompany]"));
        $this->assertEquals("street_šųößлы", $this->getValue("editval[oxuser__oxstreet]"));
        $this->assertEquals("1", $this->getValue("editval[oxuser__oxstreetnr]"));
        $this->assertEquals("3000", $this->getValue("editval[oxuser__oxzip]"));
        $this->assertEquals("City_šųößлы", $this->getValue("editval[oxuser__oxcity]"));
        $this->assertEquals("111222", $this->getValue("editval[oxuser__oxustid]"));
        $this->assertEquals("additional info_šųößлы", $this->getValue("editval[oxuser__oxaddinfo]"));
        $this->assertEquals("Germany", $this->getSelectedLabel("editval[oxuser__oxcountryid]"));
        $this->assertEquals("111222333", $this->getValue("editval[oxuser__oxfon]"));
        $this->assertEquals("222333444", $this->getValue("editval[oxuser__oxfax]"));
        $this->assertEquals("01", $this->getValue("editval[oxuser__oxbirthdate][day]"));
        $this->assertEquals("12", $this->getValue("editval[oxuser__oxbirthdate][month]"));
        $this->assertEquals("1980", $this->getValue("editval[oxuser__oxbirthdate][year]"));
        $this->assertEquals("No", substr($this->clearString($this->getText("//form[@id='myedit']/table/tbody/tr/td[1]/table/tbody/tr[17]/td[2]")), 0, 2));
        $this->assertEquals("", $this->getValue("newPassword"));
        $this->uncheck("editval[oxuser__oxactive]");
        $this->select("editval[oxuser__oxrights]", "label=Admin");
        $this->type("newPassword", "adminpass");
        $this->type("editval[oxuser__oxusername]", "birute00@nfq.lt");
        $this->type("editval[oxuser__oxcustnr]", "121");
        $this->type("editval[oxuser__oxsal]", "Mr");
        $this->type("editval[oxuser__oxfname]", "Name1");
        $this->type("editval[oxuser__oxlname]", "Surname1");
        $this->type("editval[oxuser__oxcompany]", "company1");
        $this->type("editval[oxuser__oxstreet]", "street1");
        $this->type("editval[oxuser__oxstreetnr]", "11");
        $this->type("editval[oxuser__oxzip]", "30001");
        $this->type("editval[oxuser__oxcity]", "City11");
        $this->type("editval[oxuser__oxaddinfo]", "additional info1");
        $this->select("editval[oxuser__oxcountryid]", "label=Belgium");
        $this->type("editval[oxuser__oxfon]", "1112223331");
        $this->type("editval[oxuser__oxfax]", "2223334441");
        $this->type("editval[oxuser__oxbirthdate][day]", "03");
        $this->type("editval[oxuser__oxbirthdate][month]", "13");
        $this->type("editval[oxuser__oxbirthdate][year]", "1979");
        $this->clickAndWaitFrame("save", "list");
        $this->assertEquals("off", $this->getValue("editval[oxuser__oxactive]"));
        $this->assertEquals("Admin", $this->getSelectedLabel("editval[oxuser__oxrights]"));
        $this->assertEquals("birute00@nfq.lt", $this->getValue("editval[oxuser__oxusername]"));
        $this->assertEquals("121", $this->getValue("editval[oxuser__oxcustnr]"));
        $this->assertEquals("Name1", $this->getValue("editval[oxuser__oxfname]"));
        $this->assertEquals("Surname1", $this->getValue("editval[oxuser__oxlname]"));
        $this->assertEquals("company1", $this->getValue("editval[oxuser__oxcompany]"));
        $this->assertEquals("street1", $this->getValue("editval[oxuser__oxstreet]"));
        $this->assertEquals("11", $this->getValue("editval[oxuser__oxstreetnr]"));
        $this->assertEquals("30001", $this->getValue("editval[oxuser__oxzip]"));
        $this->assertEquals("City11", $this->getValue("editval[oxuser__oxcity]"));
        $this->assertEquals("111222", $this->getValue("editval[oxuser__oxustid]"));
        $this->assertEquals("additional info1", $this->getValue("editval[oxuser__oxaddinfo]"));
        $this->assertEquals("Belgium", $this->getSelectedLabel("editval[oxuser__oxcountryid]"));
        $this->assertEquals("1112223331", $this->getValue("editval[oxuser__oxfon]"));
        $this->assertEquals("2223334441", $this->getValue("editval[oxuser__oxfax]"));
        $this->assertEquals("03", $this->getValue("editval[oxuser__oxbirthdate][day]"));
        $this->assertEquals("01", $this->getValue("editval[oxuser__oxbirthdate][month]"));
        $this->assertEquals("1979", $this->getValue("editval[oxuser__oxbirthdate][year]"));
        $this->assertEquals("Yes", substr($this->clearString($this->getText("//form[@id='myedit']/table/tbody/tr/td[1]/table/tbody/tr[17]/td[2]")), 0, 3));
        $this->assertEquals("", $this->getValue("newPassword"));
        //Addresses tab
        $this->frame("list");
        $this->openTab("link=Addresses");
        //creating addresses
        $this->assertEquals("-", $this->getSelectedLabel("//select"));
        $this->clickAndWait("btn.newaddress");
        $this->select("editval[oxaddress__oxsal]", "label=Mrs");
        $this->type("editval[oxaddress__oxfname]", "shipping name_šųößлы");
        $this->type("editval[oxaddress__oxlname]", "shipping surname_šųößлы");
        $this->type("editval[oxaddress__oxcompany]", "shipping company_šųößлы");
        $this->type("editval[oxaddress__oxstreet]", "shipping street_šųößлы");
        $this->type("editval[oxaddress__oxstreetnr]", "1");
        $this->type("editval[oxaddress__oxzip]", "1000");
        $this->type("editval[oxaddress__oxcity]", "shipping city_šųößлы");
        $this->type("editval[oxaddress__oxaddinfo]", "shipping additional info_šųößлы");
        $this->select("editval[oxaddress__oxcountryid]", "label=Italy");
        $this->type("editval[oxaddress__oxfon]", "7778788");
        $this->type("editval[oxaddress__oxfax]", "8887877");
        $this->clickAndWait("save");
        $this->assertEquals("shipping name_šųößлы shipping surname_šųößлы, shipping street_šųößлы, shipping city_šųößлы", $this->getSelectedLabel("//select"));
        $this->assertEquals("Mrs", $this->getSelectedLabel("editval[oxaddress__oxsal]"));
        $this->assertEquals("shipping name_šųößлы", $this->getValue("editval[oxaddress__oxfname]"));
        $this->assertEquals("shipping surname_šųößлы", $this->getValue("editval[oxaddress__oxlname]"));
        $this->assertEquals("shipping company_šųößлы", $this->getValue("editval[oxaddress__oxcompany]"));
        $this->assertEquals("shipping street_šųößлы", $this->getValue("editval[oxaddress__oxstreet]"));
        $this->assertEquals("1", $this->getValue("editval[oxaddress__oxstreetnr]"));
        $this->assertEquals("1000", $this->getValue("editval[oxaddress__oxzip]"));
        $this->assertEquals("shipping city_šųößлы", $this->getValue("editval[oxaddress__oxcity]"));
        $this->assertEquals("Italy", $this->getSelectedLabel("editval[oxaddress__oxcountryid]"));
        $this->assertEquals("7778788", $this->getValue("editval[oxaddress__oxfon]"));
        $this->assertEquals("8887877", $this->getValue("editval[oxaddress__oxfax]"));
        $this->clickAndWait("btn.newaddress");
        $this->select("editval[oxaddress__oxsal]", "label=Mrs");
        $this->type("editval[oxaddress__oxfname]", "name2");
        $this->type("editval[oxaddress__oxlname]", "last name 2");
        $this->type("editval[oxaddress__oxcompany]", "company 2");
        $this->type("editval[oxaddress__oxstreet]", "street2");
        $this->type("editval[oxaddress__oxstreetnr]", "12");
        $this->type("editval[oxaddress__oxzip]", "2001");
        $this->type("editval[oxaddress__oxcity]", "city2");
        $this->type("editval[oxaddress__oxaddinfo]", "additional info2");
        $this->select("editval[oxaddress__oxcountryid]", "label=Portugal");
        $this->type("editval[oxaddress__oxfon]", "999666");
        $this->type("editval[oxaddress__oxfax]", "666999");
        $this->clickAndWait("save");
        //deleting addresses
        $this->selectAndWait("oxaddressid", "-");
        $this->selectAndWait("oxaddressid", "label=name2 last name 2, street2, city2");
        $this->assertEquals("Mrs", $this->getSelectedLabel("editval[oxaddress__oxsal]"));
        $this->assertEquals("name2", $this->getValue("editval[oxaddress__oxfname]"));
        $this->assertEquals("last name 2", $this->getValue("editval[oxaddress__oxlname]"));
        $this->assertEquals("company 2", $this->getValue("editval[oxaddress__oxcompany]"));
        $this->assertEquals("street2", $this->getValue("editval[oxaddress__oxstreet]"));
        $this->assertEquals("12", $this->getValue("editval[oxaddress__oxstreetnr]"));
        $this->assertEquals("2001", $this->getValue("editval[oxaddress__oxzip]"));
        $this->assertEquals("city2", $this->getValue("editval[oxaddress__oxcity]"));
        $this->assertEquals("additional info2", $this->getValue("editval[oxaddress__oxaddinfo]"));
        $this->assertEquals("Portugal", $this->getSelectedLabel("editval[oxaddress__oxcountryid]"));
        $this->assertEquals("999666", $this->getValue("editval[oxaddress__oxfon]"));
        $this->assertEquals("666999", $this->getValue("editval[oxaddress__oxfax]"));
        $this->selectAndWait("oxaddressid", "label=shipping name_šųößлы shipping surname_šųößлы, shipping street_šųößлы, shipping city_šųößлы");
        $this->assertEquals("Mrs", $this->getSelectedLabel("editval[oxaddress__oxsal]"));
        $this->assertEquals("shipping name_šųößлы", $this->getValue("editval[oxaddress__oxfname]"));
        $this->assertEquals("shipping surname_šųößлы", $this->getValue("editval[oxaddress__oxlname]"));
        $this->assertEquals("shipping company_šųößлы", $this->getValue("editval[oxaddress__oxcompany]"));
        $this->assertEquals("shipping street_šųößлы", $this->getValue("editval[oxaddress__oxstreet]"));
        $this->assertEquals("1", $this->getValue("editval[oxaddress__oxstreetnr]"));
        $this->assertEquals("1000", $this->getValue("editval[oxaddress__oxzip]"));
        $this->assertEquals("shipping city_šųößлы", $this->getValue("editval[oxaddress__oxcity]"));
        $this->assertEquals("shipping additional info_šųößлы", $this->getValue("editval[oxaddress__oxaddinfo]"));
        $this->assertEquals("Italy", $this->getSelectedLabel("editval[oxaddress__oxcountryid]"));
        $this->assertEquals("7778788", $this->getValue("editval[oxaddress__oxfon]"));
        $this->assertEquals("8887877", $this->getValue("editval[oxaddress__oxfax]"));
        $this->clickAndWait("//input[@value='Delete']");
        $this->assertTrue($this->isElementPresent("oxaddressid"), "Failed to delete address in Admin: Users -> Addresses tab");
        $this->assertEquals("- name2 last name 2, street2, city2", $this->clearString($this->getText("oxaddressid")));
        $this->selectAndWait("oxaddressid", "label=name2 last name 2, street2, city2");
        $this->assertEquals("Mrs", $this->getSelectedLabel("editval[oxaddress__oxsal]"));
        $this->assertEquals("name2", $this->getValue("editval[oxaddress__oxfname]"));
        $this->assertEquals("last name 2", $this->getValue("editval[oxaddress__oxlname]"));
        $this->assertEquals("company 2", $this->getValue("editval[oxaddress__oxcompany]"));
        $this->assertEquals("street2", $this->getValue("editval[oxaddress__oxstreet]"));
        $this->assertEquals("12", $this->getValue("editval[oxaddress__oxstreetnr]"));
        $this->assertEquals("2001", $this->getValue("editval[oxaddress__oxzip]"));
        $this->assertEquals("city2", $this->getValue("editval[oxaddress__oxcity]"));
        $this->assertEquals("additional info2", $this->getValue("editval[oxaddress__oxaddinfo]"));
        $this->assertEquals("Portugal", $this->getSelectedLabel("editval[oxaddress__oxcountryid]"));
        $this->assertEquals("999666", $this->getValue("editval[oxaddress__oxfon]"));
        $this->assertEquals("666999", $this->getValue("editval[oxaddress__oxfax]"));
        $this->clickAndWait("//input[@value='Delete']");
        $this->assertEquals("-", $this->getText("//select"));
        $this->assertEquals("Mr", $this->getSelectedLabel("editval[oxaddress__oxsal]"));
        $this->assertEquals("", $this->getValue("editval[oxaddress__oxfname]"));
        $this->assertEquals("", $this->getValue("editval[oxaddress__oxlname]"));
        $this->assertEquals("", $this->getValue("editval[oxaddress__oxcompany]"));
        $this->assertEquals("", $this->getValue("editval[oxaddress__oxstreet]"));
        $this->assertEquals("", $this->getValue("editval[oxaddress__oxstreetnr]"));
        $this->assertEquals("", $this->getValue("editval[oxaddress__oxzip]"));
        $this->assertEquals("", $this->getValue("editval[oxaddress__oxcity]"));
        $this->assertEquals("", $this->getValue("editval[oxaddress__oxaddinfo]"));
        $this->assertEquals("Austria", $this->getSelectedLabel("editval[oxaddress__oxcountryid]"));
        $this->assertEquals("", $this->getValue("editval[oxaddress__oxfon]"));
        $this->assertEquals("", $this->getValue("editval[oxaddress__oxfax]"));
        $this->assertTrue($this->isElementPresent("save"));
        //History tab
        $this->frame("list");
        $this->openTab("link=History");
        $this->assertNotEquals("", $this->getText("//select[@name='rem_oxid']"));
        $this->clickAndWait("btn.newremark");
        $this->type("remarktext", "new note_šųößлы");
        $this->clickAndWait("save");
        $this->selectAndWait("//select[@name='rem_oxid']", "index=0");
        $this->assertEquals("new note_šųößлы", $this->getValue("remarktext"));
        $this->clickAndWait("//input[@value='Delete']");
        $this->assertNotEquals("", $this->getText("//select[@name='rem_oxid']"));
        $this->selectAndWait("//select[@name='rem_oxid']", "index=0");
        $this->assertNotEquals("new note_šųößлы", $this->getValue("remarktext"));
        //testing if other tabs are working
        $this->frame("list");
        $this->openTab("link=Products");
        $this->frame("list");
        $this->openTab("link=Payment");
        $this->frame("list");
        $this->openTab("link=Extended");
        //checking if created item can be found
        $this->frame("list");
        $this->type("where[oxuser][oxusername]", "birute00");
        $this->clickAndWait("submitit");
        $this->assertEquals("birute00@nfq.lt", $this->getText("//tr[@id='row.1']/td[2]"));
        $this->assertFalse($this->isElementPresent("//tr[@id='row.2']/td[2]"));
    }

    /*
     * seo: Core settings -> SEO
     * @group admin
     * @group seo
     */
    public function testSeoCoreSettingsInternational()
    {
        $this->loginAdmin("Master Settings", "Core Settings");
        $this->openTab("link=SEO");
        $this->assertEquals("English", $this->getSelectedLabel("test_editlanguage"));
        $this->selectAndWait("test_editlanguage", "label=Deutsch");
        $this->assertEquals("Deutsch", $this->getSelectedLabel("test_editlanguage"));
        $this->type("editval[oxshops__oxtitleprefix]", "prefix DE");
        $this->type("editval[oxshops__oxtitlesuffix]", "suffix DE");
        $this->type("editval[oxshops__oxstarttitle]", "title DE");
        $this->clickAndWait("//input[@name='save' and @value='Save']");
        $this->assertEquals("prefix DE", $this->getValue("editval[oxshops__oxtitleprefix]"), "After information was edited and saved, old values before editing are displayed");
        $this->assertEquals("suffix DE", $this->getValue("editval[oxshops__oxtitlesuffix]"), "After information was edited and saved, old values before editing are displayed");
        $this->assertEquals("title DE", $this->getValue("editval[oxshops__oxstarttitle]"), "After information was edited and saved, old values before editing are displayed");
        $this->selectAndWait("test_editlanguage", "label=English");
        $this->type("editval[oxshops__oxtitleprefix]", "prefix EN šųößлы");
        $this->type("editval[oxshops__oxtitlesuffix]", "suffix EN šųößлы");
        $this->type("editval[oxshops__oxstarttitle]", "title EN šųößлы");
        $this->clickAndWait("//input[@name='save' and @value='Save']");
        $this->assertEquals("prefix EN šųößлы", $this->getValue("editval[oxshops__oxtitleprefix]"));
        $this->assertEquals("suffix EN šųößлы", $this->getValue("editval[oxshops__oxtitlesuffix]"));
        $this->assertEquals("title EN šųößлы", $this->getValue("editval[oxshops__oxstarttitle]"));
        $this->selectAndWait("test_editlanguage", "label=Deutsch");
        $this->assertEquals("prefix DE", $this->getValue("editval[oxshops__oxtitleprefix]"));
        $this->assertEquals("suffix DE", $this->getValue("editval[oxshops__oxtitlesuffix]"));
        $this->assertEquals("title DE", $this->getValue("editval[oxshops__oxstarttitle]"));
        $this->selectAndWait("test_editlanguage", "label=English");
        $this->assertEquals("prefix EN šųößлы", $this->getValue("editval[oxshops__oxtitleprefix]"));
        $this->assertEquals("suffix EN šųößлы", $this->getValue("editval[oxshops__oxtitlesuffix]"));
        $this->assertEquals("title EN šųößлы", $this->getValue("editval[oxshops__oxstarttitle]"));
        $this->type("confstrs[sSEOSeparator]", "+");
        $this->type("confstrs[sSEOuprefix]", "pre");
        $this->clickAndWait("//input[@name='save' and @value='Save']");
        $this->assertEquals("+", $this->getValue("confstrs[sSEOSeparator]"));
        $this->assertEquals("pre", $this->getValue("confstrs[sSEOuprefix]"));
        $this->type("confstrs[sSEOSeparator]", "");
        $this->type("confstrs[sSEOuprefix]", "");
        $this->clickAndWait("//input[@name='save' and @value='Save']");
        $this->assertEquals("", $this->getValue("confstrs[sSEOSeparator]"));
        $this->assertEquals("", $this->getValue("confstrs[sSEOuprefix]"));
        //resetting seo ID's'
        $this->clickAndConfirm("//input[@name='save' and @value='Update SEO URLs']");
        //checking shop title in frontend
        $this->openShop();
        $this->assertEquals("prefix EN šųößлы | title EN šųößлы", $this->getTitle());
        $this->clickAndWait("test_BoxLeft_Cat_testcategory0_2");
        $this->assertEquals("Test category 0 [EN] šųößлы", $this->getText("test_BoxLeft_Cat_testcategory0_2"));
        $this->assertEquals("prefix EN šųößлы | Test category 0 [EN] šųößлы | suffix EN šųößлы", $this->getTitle());
    }

    /*
     * simple user account opening
     * @group user
     */
    public function testStandardUserRegistrationInternational()
    {
        //creating user
        $this->openShop();
        $this->clickAndWait("test_RightLogin_Register");
        $this->type("test_lgn_usr", "birute01@nfq.lt");
        $this->type("userPassword", "user11");
        $this->type("userPasswordConfirm", "user11");
        $this->assertEquals("off", $this->getValue("document.order.blnewssubscribed[1]"));
        $this->uncheck("document.order.blnewssubscribed[1]");
        $this->type("invadr[oxuser__oxfname]", "user1 name_šųößлы");
        $this->type("invadr[oxuser__oxlname]", "user1 last name_šųößлы");
        $this->type("invadr[oxuser__oxcompany]", "user1 company_šųößлы");
        $this->type("invadr[oxuser__oxstreet]", "user1 street_šųößлы");
        $this->type("invadr[oxuser__oxstreetnr]", "1");
        $this->type("invadr[oxuser__oxzip]", "11");
        $this->type("invadr[oxuser__oxcity]", "user1 city_šųößлы");
        $this->type("invadr[oxuser__oxustid]", "");
        $this->type("invadr[oxuser__oxaddinfo]", "user1 additional info_šųößлы");
        $this->select("invadr[oxuser__oxcountryid]", "label=Germany");
        $this->type("invadr[oxuser__oxfon]", "111-111");
        $this->type("invadr[oxuser__oxfax]", "111-111-111");
        $this->type("invadr[oxuser__oxmobfon]", "111-111111");
        $this->type("invadr[oxuser__oxprivfon]", "111111111");
        $this->type("invadr[oxuser__oxbirthdate][day]", "11");
        $this->type("invadr[oxuser__oxbirthdate][month]", "11");
        $this->type("invadr[oxuser__oxbirthdate][year]", "1981");
        $this->clickAndWait("blshowshipaddress");
        $this->assertTrue($this->isElementPresent("userLoginName"), "form fields for delivery address is not shown");
        $this->assertEquals("birute01@nfq.lt", $this->getValue("userLoginName"));
        $this->assertEquals("", $this->getValue("userPassword"));
        $this->assertEquals("", $this->getValue("userPasswordConfirm"));
        $this->assertEquals("off", $this->getValue("document.order.blnewssubscribed[1]"));
        $this->assertEquals("user1 name_šųößлы", $this->getValue("invadr[oxuser__oxfname]"));
        $this->assertEquals("user1 last name_šųößлы", $this->getValue("invadr[oxuser__oxlname]"));
        $this->assertEquals("user1 company_šųößлы", $this->getValue("invadr[oxuser__oxcompany]"));
        $this->assertEquals("user1 street_šųößлы", $this->getValue("invadr[oxuser__oxstreet]"));
        $this->assertEquals("1", $this->getValue("invadr[oxuser__oxstreetnr]"));
        $this->assertEquals("11", $this->getValue("invadr[oxuser__oxzip]"));
        $this->assertEquals("user1 city_šųößлы", $this->getValue("invadr[oxuser__oxcity]"));
        $this->assertEquals("", $this->getValue("invadr[oxuser__oxustid]"));
        $this->assertEquals("user1 additional info_šųößлы", $this->getValue("invadr[oxuser__oxaddinfo]"));
        $this->assertEquals("Germany", $this->getSelectedLabel("invadr[oxuser__oxcountryid]"));
        $this->assertEquals("111-111", $this->getValue("invadr[oxuser__oxfon]"));
        $this->assertEquals("111-111-111", $this->getValue("invadr[oxuser__oxfax]"));
        $this->assertEquals("111-111111", $this->getValue("invadr[oxuser__oxmobfon]"));
        $this->assertEquals("111111111", $this->getValue("invadr[oxuser__oxprivfon]"));
        $this->assertEquals("11", $this->getValue("invadr[oxuser__oxbirthdate][day]"));
        $this->assertEquals("11", $this->getValue("invadr[oxuser__oxbirthdate][month]"));
        $this->assertEquals("1981", $this->getValue("invadr[oxuser__oxbirthdate][year]"));
        $this->type("userPassword", "user11");
        $this->type("userPasswordConfirm", "user11");
        $this->assertTrue($this->isVisible("deladr[oxaddress__oxfname]"));
        $this->type("deladr[oxaddress__oxfname]", "user1_2 name_šųößлы");
        $this->type("deladr[oxaddress__oxlname]", "user1_2 last name_šųößлы");
        $this->type("deladr[oxaddress__oxcompany]", "user1_2 company_šųößлы");
        $this->type("deladr[oxaddress__oxstreet]", "user1_2 street_šųößлы");
        $this->type("deladr[oxaddress__oxstreetnr]", "1_2");
        $this->type("deladr[oxaddress__oxzip]", "1_2");
        $this->type("deladr[oxaddress__oxcity]", "user1_2 city_šųößлы");
        $this->type("deladr[oxaddress__oxaddinfo]", "user1_2 additional info_šųößлы");
        $this->select("deladr[oxaddress__oxcountryid]", "label=Germany");
        $this->type("deladr[oxaddress__oxfon]", "111-222");
        $this->type("deladr[oxaddress__oxfax]", "111-111-222");
        $this->clickAndWait("//input[@value='Send']");
        $this->assertTrue($this->isTextPresent("We welcome you as registered user!"));
        $this->assertTrue($this->isTextPresent("You're logged in as:"));
        $this->loginAdmin("Administer Users", "Users");
        $this->type("where[oxuser][oxlname]", "user1");
        $this->clickAndWait("submitit");
        $this->assertEquals("user1 last name_šųößлы user1 name_šųößлы", $this->getText("//tr[@id='row.1']/td[1]"));
        $this->openTab("link=user1 last name_šųößлы user1 name_šųößлы");
        $this->assertEquals("on", $this->getValue("editval[oxuser__oxactive]"));
        $this->assertEquals("birute01@nfq.lt", $this->getValue("editval[oxuser__oxusername]"));
        $this->assertEquals("user1 name_šųößлы", $this->getValue("editval[oxuser__oxfname]"));
        $this->assertEquals("user1 last name_šųößлы", $this->getValue("editval[oxuser__oxlname]"));
        $this->assertEquals("user1 company_šųößлы", $this->getValue("editval[oxuser__oxcompany]"));
        $this->assertEquals("user1 street_šųößлы", $this->getValue("editval[oxuser__oxstreet]"));
        $this->assertEquals("1", $this->getValue("editval[oxuser__oxstreetnr]"));
        $this->assertEquals("11", $this->getValue("editval[oxuser__oxzip]"));
        $this->assertEquals("user1 city_šųößлы", $this->getValue("editval[oxuser__oxcity]"));
        $this->assertEquals("", $this->getValue("editval[oxuser__oxustid]"));
        $this->assertEquals("user1 additional info_šųößлы", $this->getValue("editval[oxuser__oxaddinfo]"));
        $this->assertEquals("Germany", $this->getSelectedLabel("editval[oxuser__oxcountryid]"));
        $this->assertEquals("111-111", $this->getValue("editval[oxuser__oxfon]"));
        $this->assertEquals("111-111-111", $this->getValue("editval[oxuser__oxfax]"));
        $this->assertEquals("11", $this->getValue("editval[oxuser__oxbirthdate][day]"));
        $this->assertEquals("11", $this->getValue("editval[oxuser__oxbirthdate][month]"));
        $this->assertEquals("1981", $this->getValue("editval[oxuser__oxbirthdate][year]"));
        $this->assertTrue($this->isTextPresent("Yes"));
        $this->frame("list");
        $this->openTab("link=Extended");
        $this->assertEquals("111111111", $this->getValue("editval[oxuser__oxprivfon]"));
        $this->assertEquals("111-111111", $this->getValue("editval[oxuser__oxmobfon]"));
        $this->frame("list");
        $this->openTab("link=Addresses");
        $this->selectAndWait("addressid", "label=user1_2 name_šųößлы user1_2 last name_šųößлы, user1_2 street_šųößлы, user1_2 city_šųößлы");
        $this->assertEquals("Mr", $this->getSelectedLabel("editval[oxaddress__oxsal]"));
        $this->assertEquals("user1_2 name_šųößлы", $this->getValue("editval[oxaddress__oxfname]"));
        $this->assertEquals("user1_2 last name_šųößлы", $this->getValue("editval[oxaddress__oxlname]"));
        $this->assertEquals("user1_2 company_šųößлы", $this->getValue("editval[oxaddress__oxcompany]"));
        $this->assertEquals("user1_2 street_šųößлы", $this->getValue("editval[oxaddress__oxstreet]"));
        $this->assertEquals("1_2", $this->getValue("editval[oxaddress__oxstreetnr]"));
        $this->assertEquals("1_2", $this->getValue("editval[oxaddress__oxzip]"));
        $this->assertEquals("user1_2 city_šųößлы", $this->getValue("editval[oxaddress__oxcity]"));
        $this->assertEquals("user1_2 additional info_šųößлы", $this->getValue("editval[oxaddress__oxaddinfo]"));
        $this->assertEquals("Germany", $this->getSelectedLabel("editval[oxaddress__oxcountryid]"));
        $this->assertEquals("111-222", $this->getValue("editval[oxaddress__oxfon]"));
        $this->assertEquals("111-111-222", $this->getValue("editval[oxaddress__oxfax]"));
    }

    /*
     * Checking Tags functionality
     * @group navigation
     */
    public function testFrontendTagsInternational()
    {
        $this->clearTmp();
        $this->openShop();
        $this->assertEquals("Tags", $this->getText("tags"));
        $this->assertTrue($this->isElementPresent("link=More..."));
        $this->clickAndWait("link=More...");
        $this->assertEquals("You are here: / Tags", $this->getText("path"));
        $this->assertEquals("Tags", $this->getText("tags"));
        $this->assertTrue($this->isElementPresent("link=[EN]"));
        $this->assertTrue($this->isElementPresent("link=šųößлы"));
        $this->assertTrue($this->isElementPresent("link=tag"));
        $this->assertTrue($this->isElementPresent("link=1"));
        $this->assertTrue($this->isElementPresent("link=2"));
        $this->assertTrue($this->isElementPresent("link=3"));
        $this->clickAndWait("link=Home");
        $this->assertEquals("You are here: / Home All prices incl. VAT, plus Shipping", $this->clearString($this->getText("path")));
        $this->assertTrue($this->isElementPresent("link=tag"));
        $this->clickAndWait("link=šųößлы");
        $this->assertEquals("You are here: / Tags / Šųößлы", $this->getText("path"));
        $this->assertEquals("Šųößлы", $this->getText("test_catTitle"));
        $this->assertTrue($this->isElementPresent("test_ArtPerPageTop_10"));
        $this->assertTrue($this->isElementPresent("test_sortTop_oxtitle_asc"));
        $this->assertTrue($this->isElementPresent("test_title_action_1000"));
        $this->assertTrue($this->isElementPresent("test_title_action_1001"));
        $this->assertTrue($this->isElementPresent("test_title_action_1002"));
        $this->assertTrue($this->isElementPresent("test_title_action_1003"));
        $this->assertTrue($this->isElementPresent("test_cntr_4"));
        $this->assertFalse($this->isElementPresent("test_cntr_5"));
        $this->clickAndWait("test_ArtPerPageTop_2");
        $this->assertEquals("Page 1 / 2", $this->getText("test_listXofY_Top"));
        $this->assertEquals("Test product 0 [EN] šųößлы", $this->getText("test_title_action_1000"));
        $this->assertEquals("Test product 1 [EN] šųößлы", $this->getText("test_title_action_1001"));
        $this->assertFalse($this->isElementPresent("test_cntr_3"));
        $this->clickAndWait("test_PageNrTop_2");
        $this->assertEquals("Page 2 / 2", $this->getText("test_listXofY_Top"));
        $this->assertEquals("Test product 2 [EN] šųößлы", $this->getText("test_title_action_1002"));
        $this->assertEquals("Test product 3 [EN] šųößлы", $this->getText("test_title_action_1003"));
        $this->assertFalse($this->isElementPresent("test_cntr_3"));
        $this->clickAndWait("test_sortTop_oxvarminprice_asc");
        $this->assertEquals("Page 1 / 2", $this->getText("test_listXofY_Top"));
        $this->assertEquals("Test product 0 [EN] šųößлы", $this->getText("test_title_action_1000"));
        $this->assertEquals("50,00 €*", $this->getText("test_price_action_1000"));
        $this->assertEquals("Test product 2 [EN] šųößлы", $this->getText("test_title_action_1002"));
        $this->assertEquals("from 55,00 €*", $this->getText("test_price_action_1002"));
        $this->assertFalse($this->isElementPresent("test_cntr_3"));
        $this->clickAndWait("test_PageNrTop_2");
        $this->assertEquals("Page 2 / 2", $this->getText("test_listXofY_Top"));
        $this->assertEquals("Test product 3 [EN] šųößлы", $this->getText("test_title_action_1003"));
        $this->assertEquals("75,00 €*", $this->getText("test_price_action_1003"));
        $this->assertEquals("Test product 1 [EN] šųößлы", $this->getText("test_title_action_1001"));
        $this->assertEquals("100,00 €*", $this->getText("test_price_action_1001"));
        $this->clickAndWait("test_ArtPerPageTop_10");
        $this->clickAndWait("test_sortTop_oxtitle_asc");
        $this->assertTrue($this->isElementPresent("test_cntr_1_1000"));
        $this->assertTrue($this->isElementPresent("test_cntr_2_1001"));
        $this->assertTrue($this->isElementPresent("test_cntr_3_1002"));
        $this->assertTrue($this->isElementPresent("test_cntr_4_1003"));
        $this->assertTrue($this->isElementPresent("test_cntr_4"));
        $this->assertFalse($this->isElementPresent("test_cntr_5"));
        $this->clickAndWait("test_title_action_1002");
        $this->assertTrue($this->isElementPresent("test_product_name"));
        $this->assertEquals("You are here: / Tags / Šųößлы", $this->getText("path"));
        $this->assertEquals("Tags", $this->getText("tags"));
        $this->assertTrue($this->isElementPresent("link=tag"));
        $this->type("test_RightLogin_Email", "birute_test@nfq.lt");
        $this->type("test_RightLogin_Pwd", "useruser");
        $this->clickAndWait("test_RightLogin_Login");
        $this->assertTrue($this->isElementPresent("test_editTag"));
        $this->clickAndWait("test_editTag");
        $this->assertTrue($this->isTextPresent("Add tags:"));
        $this->type("newTags", "new_tag");
        $this->clickAndWait("test_saveTag");
        $this->assertTrue($this->isElementPresent("link=new_tag"));
        $this->clickAndWait("link=new_tag");
        $this->assertEquals("You are here: / Tags / New_tag", $this->getText("path"));
        $this->assertEquals("New_tag", $this->getText("test_catTitle"));
        $this->assertTrue($this->isElementPresent("test_title_action_1002"));
        $this->assertTrue($this->isElementPresent("test_cntr_1"));
        $this->assertFalse($this->isElementPresent("test_cntr_2"));
    }

    /*
     * Search in frontend
     * @group navigation
     */
    public function testFrontendSearchInternational()
    {
        $this->openShop();
        //searching for 1 product (using product search field value)
        $this->type("//input[@id='f.search.param']", "šųößлы1000");
        $this->clickAndWait("test_searchGo");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->assertTrue($this->isElementPresent("//a[@id='rssSearchProducts']"));
        $this->assertEquals("1 Hits for \"šųößлы1000\"", $this->getText("test_smallHeader"));
        $this->assertEquals("2 kg | 25,00 €/kg", $this->getText("test_no_Search_1000"));
        $this->assertEquals("Test product 0 short desc [EN] šųößлы", $this->getText("test_shortDesc_Search_1000"));
        $this->assertEquals("50,00 €*", $this->getText("test_price_Search_1000"));
        $this->assertEquals("Test product 0 [EN] šųößлы", $this->getText("test_title_Search_1000"));
        $this->clickAndWait("test_title_Search_1000");
        $this->assertEquals("You are here: / Search result for \"šųößлы1000\"", $this->getText("path"));
        $this->assertEquals("Test product 0 [EN] šųößлы", $this->getText("test_product_name"));
        $this->clickAndWait("test_BackOverviewTop");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->clickAndWait("test_pic_Search_1000");
        $this->assertEquals("You are here: / Search result for \"šųößлы1000\"", $this->getText("path"));
        $this->assertEquals("Test product 0 [EN] šųößлы", $this->getText("test_product_name"));
        $this->clickAndWait("test_BackOverviewTop");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->clickAndWait("test_details_Search_1000");
        $this->assertEquals("You are here: / Search result for \"šųößлы1000\"", $this->getText("path"));
        $this->assertEquals("Test product 0 [EN] šųößлы", $this->getText("test_product_name"));
        $this->clickAndWait("test_BackOverviewTop");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->assertFalse($this->isElementPresent("test_AccComparison"));
        $this->clickAndWait("test_toCmp_Search_1000");
        $this->assertEquals("remove from compare list", $this->getText("test_removeCmp_Search_1000"));
        $this->assertTrue($this->isElementPresent("test_AccComparison"));
        $this->clickAndWait("test_removeCmp_Search_1000");
        $this->assertFalse($this->isElementPresent("test_AccComparison"));
        $this->type("test_am_Search_1000", "3");
        $this->clickAndWait("test_toBasket_Search_1000");
        $this->assertEquals("1", $this->getText("test_RightBasketProducts"));
        $this->assertEquals("3", $this->getText("test_RightBasketItems"));
        $this->assertEquals("150,00 €", $this->getText("test_RightBasketTotal"));
        $this->type("test_am_Search_1000", "1");
        $this->clickAndWait("test_toBasket_Search_1000");
        $this->assertEquals("1", $this->getText("test_RightBasketProducts"));
        $this->assertEquals("4", $this->getText("test_RightBasketItems"));
        $this->assertEquals("200,00 €", $this->getText("test_RightBasketTotal"));
        //search that match several products
        //art num is not considered in search
        oxDb::getDb()->Execute("UPDATE `oxconfig` SET `OXVARVALUE` = 0x4dba852e75e64cf5ccd4ae621339e6050ec87b19ce6db38ed423f15be38d4577f34fedf3f652aeac5b74f9499d5db396220d12940b184d723995e5101b2481c7 WHERE `OXVARNAME` = 'aSearchCols'");
        $this->type("//input[@id='f.search.param']", "100");
        $this->clickAndWait("test_searchGo");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->assertTrue($this->isTextPresent("Sorry, no items found."));
        //art num is considered in search
        oxDb::getDb()->Execute("UPDATE `oxconfig` SET `OXVARVALUE` = 0x4dba682873e04af3cad2a864153fe00308ce7d1fc86bb588d225f75de58b4371f549ebf5f054a8aa5d72ff4f9b5bb590240b14921d5f21962f67c7bd29417e61149f025b96cdf815d975cc85278913ee4b505bdfea13af328807c5ddd68d655b20d74de1e812236ebd97ee WHERE `OXVARNAME` = 'aSearchCols'");
        $this->type("//input[@id='f.search.param']", "100");
        $this->clickAndWait("test_searchGo");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->assertEquals("4 Hits for \"100\"", $this->getText("test_smallHeader"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1000"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1001"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1002"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1003"));
        //search with selecting category
        $this->type("//input[@id='f.search.param']", "100");
        $this->select("searchcnid", "index=7");
        $this->select("test_searchManufacturerSelect", "index=0");
        $this->clickAndWait("test_searchGo");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->assertEquals("2 Hits for \"100\"", $this->getText("test_smallHeader"));
        $this->assertFalse($this->isElementPresent("test_title_Search_1000"));
        $this->assertFalse($this->isElementPresent("test_title_Search_1001"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1002"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1003"));
        //search by vendor
        $this->type("//input[@id='f.search.param']", "100");
        $this->select("searchcnid", "index=0");
        $this->select("test_searchManufacturerSelect", "label=Manufacturer [EN] šųößлы");
        $this->clickAndWait("test_searchGo");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->assertEquals("4 Hits for \"100\"", $this->getText("test_smallHeader"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1000"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1001"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1002"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1003"));
        //not existing search
        $this->type("//input[@id='f.search.param']", "noExisting");
        $this->select("searchcnid", "index=0");
        $this->select("test_searchManufacturerSelect", "index=0");
        $this->clickAndWait("test_searchGo");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->assertTrue($this->isTextPresent("Sorry, no items found."));
        //search in language
        $this->type("//input[@id='f.search.param']", "[EN] šųößлы");
        $this->clickAndWait("test_searchGo");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->assertEquals("4 Hits for \"[EN] šųößлы\"", $this->getText("test_smallHeader"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1000"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1001"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1002"));
        $this->assertTrue($this->isElementPresent("test_title_Search_1003"));
        //AND is used for search keys
        oxDb::getDb()->Execute("UPDATE `oxconfig` SET `OXVARVALUE` = 0x93ea1218 WHERE `OXVARNAME` = 'blSearchUseAND'");
        $this->type("//input[@id='f.search.param']", "1000 1001");
        $this->clickAndWait("test_searchGo");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->assertTrue($this->isTextPresent("Sorry, no items found."));
        //OR is used for search keys
        oxDb::getDb()->Execute("UPDATE `oxconfig` SET `OXVARVALUE` = 0x7900fdf51e WHERE `OXVARNAME` = 'blSearchUseAND'");
        $this->type("//input[@id='f.search.param']", "1000 1001");
        $this->clickAndWait("test_searchGo");
        $this->assertEquals("You are here: / Search", $this->getText("path"));
        $this->assertEquals("2 Hits for \"1000 1001\"", $this->getText("test_smallHeader"));
        //search automatically, if category is selected
        oxDb::getDb()->execute("DELETE FROM `oxconfig` WHERE `OXVARNAME`='blAutoSearchOnCat'");
            oxDb::getDb()->execute( "INSERT INTO `oxconfig` (`OXID`, `OXSHOPID`, `OXVARNAME`, `OXVARTYPE`, `OXVARVALUE`) VALUES ('9d1ee3af23795dea96terf2d1e', 'oxbaseshop', 'blAutoSearchOnCat', 'bool', 0x93ea1218);" );
        $this->clickAndWait("link=Home");
        $this->type("//input[@id='f.search.param']", "1001");
        $this->selectAndWait("searchcnid", "index=6");
        $this->assertEquals("1 Hits for \"1001\"", $this->getText("test_smallHeader"));
        $this->assertEquals("Test product 1 [EN] šųößлы", $this->getText("test_title_Search_1001"));
    }


    /*
     * My Account navigation: changing password
     * @group navigation
     * @group user
     */
    public function testFrontendMyAccountPassInternational()
    {
        $this->openShop();
        $this->type("test_RightLogin_Email", "birute_test@nfq.lt");
        $this->type("test_RightLogin_Pwd", "useruser");
        $this->clickAndWait("test_RightLogin_Login");
        $this->clickAndWait("link=My Account");
        //changing password
        $this->assertEquals("You are here: / My Account", $this->getText("path"));
        $this->assertEquals("You're logged in as: \"birute_test@nfq.lt\" (UserNameįÄк UserSurnam...)", $this->clearString($this->getText("test_LoginUser")));
        $this->assertEquals("Change Account Password", $this->getText("test_link_account_passwordDesc"));
        $this->clickAndWait("test_link_account_password");
        $this->assertEquals("Personal Settings", $this->getText("test_personalSettingsHeader"));
        $this->assertTrue($this->isTextPresent("Change Password"));
        $this->assertTrue($this->isTextPresent("Note:The Password minimum length is 6 characters."));
        //entered diff new passwords
        $this->type("password_old", "useruser");
        $this->type("password_new", "user1user");
        $this->type("password_new_confirm", "useruser");
        $this->clickAndWait("test_savePass");
        $this->assertTrue($this->isTextPresent("Error: Passwords don't match."));
        //new pass is too short
        $this->type("password_old", "useruser");
        $this->type("password_new", "user");
        $this->type("password_new_confirm", "user");
        $this->clickAndWait("test_savePass");
        $this->assertTrue($this->isTextPresent("Error: Your Password is too short."));
        //correct new pass
        $this->type("password_old", "useruser");
        $this->type("password_new", "user1userįÄк");
        $this->type("password_new_confirm", "user1userįÄк");
        $this->clickAndWait("test_savePass");
        $this->assertEquals("Personal Settings", $this->getText("test_personalSettingsHeader"));
        $this->assertTrue($this->isTextPresent("Your Password has changed."));
        $this->clickAndWait("test_link_account_logout");
        $this->type("test_RightLogin_Email", "birute_test@nfq.lt");
        $this->type("test_RightLogin_Pwd", "useruser");
        $this->clickAndWait("test_RightLogin_Login");
        $this->assertTrue($this->isTextPresent("Wrong e-Mail or password!"));
        $this->type("test_RightLogin_Email", "birute_test@nfq.lt");
        $this->type("test_RightLogin_Pwd", "user1userįÄк");
        $this->clickAndWait("test_RightLogin_Login");
        $this->assertEquals("You're logged in as: \"birute_test@nfq.lt\" (UserNameįÄк UserSurnam...)", $this->clearString($this->getText("test_LoginUser")));
    }

    /*
     * Order steps: Step1
     * @group order
     * @group user
     * @group navigation
     */
    public function testFrontendOrderStep1International()
    {
        $this->openShop();
        //adding products to the basket
        $this->type("//input[@id='f.search.param']", "100");
        $this->clickAndWait("test_searchGo");
        $this->select("selectList_Search_1001_0", "index=2");
        $this->clickAndWait("test_toBasket_Search_1001");
        $this->select("varSelect_Search_1002", "index=1");
        $this->clickAndWait("test_toBasket_Search_1002");
        $this->type("test_am_Search_1003", "6");
        $this->clickAndWait("test_toBasket_Search_1003");
        $this->clickAndWait("test_toBasket_Search_1000");
        $this->clickAndWait("link=Cart");
        $this->assertEquals("You are here: / View Cart", $this->getText("path"));
        $this->type("voucherNr", "222222");
        $this->clickAndWait("test_basketVoucherAdd");
        $this->assertTrue($this->isTextPresent("Your Coupon 222222 couldn't be accepted."));
        $this->assertTrue($this->isTextPresent("The coupon is not valid for your user group!"));
        $this->type("test_RightLogin_Email", "birute_test@nfq.lt");
        $this->type("test_RightLogin_Pwd", "useruser");
        $this->clickAndWait("test_RightLogin_Login");
        $this->assertEquals("Redeem Coupon", $this->getText("test_VoucherHeader"));
        $this->type("voucherNr", "111111");
        $this->clickAndWait("test_basketVoucherAdd");
        //Order Step1
        $this->assertEquals("Test product 1 [EN] šųößлы", $this->getText("test_basketTitle_1001_1"));
        $this->assertEquals("Test product 2 [EN] šųößлы, var2 [EN] šųößлы", $this->getText("test_basketTitle_1002-2_2"));
        $this->assertEquals("Test product 3 [EN] šųößлы", $this->getText("test_basketTitle_1003_3"));
        $this->assertEquals("Test product 0 [EN] šųößлы", $this->getText("test_basketTitle_1000_4"));
        $this->assertEquals("Art.No.: 1000", $this->getText("test_basketNo_1000_4"));
        $this->assertEquals("Art.No.: 1001", $this->getText("test_basketNo_1001_1"));
        $this->assertEquals("Art.No.: 1002-2", $this->getText("test_basketNo_1002-2_2"));
        $this->assertEquals("Art.No.: 1003", $this->getText("test_basketNo_1003_3"));
        //testing product with selection list
        $this->assertEquals("selvar3 [EN] įÄк -2,00 €", $this->getSelectedLabel("test_basketSelect_1001_1_0"));
        $this->assertEquals("98,00 €", $this->getText("test_basket_Price_1001_1"));
        $this->assertEquals("10%", $this->getText("test_basket_Vat_1001_1"));
        $this->assertEquals("98,00 €", $this->getText("test_basket_TotalPrice_1001_1"));
        $this->select("test_basketSelect_1001_1_0", "index=1");
        $this->clickAndWait("test_basketUpdate");
        $this->assertEquals("100,00 €", $this->getText("test_basket_Price_1001_1"));
        $this->assertEquals("10%", $this->getText("test_basket_Vat_1001_1"));
        $this->assertEquals("100,00 €", $this->getText("test_basket_TotalPrice_1001_1"));
        $this->select("test_basketSelect_1001_1_0", "index=3");
        $this->clickAndWait("test_basketUpdate");
        $this->assertEquals("102,00 €", $this->getText("test_basket_Price_1001_1"));
        $this->assertEquals("10%", $this->getText("test_basket_Vat_1001_1"));
        $this->assertEquals("102,00 €", $this->getText("test_basket_TotalPrice_1001_1"));
        $this->select("test_basketSelect_1001_1_0", "index=0");
        $this->clickAndWait("test_basketUpdate");
        $this->assertEquals("101,00 €", $this->getText("test_basket_Price_1001_1"));
        $this->assertEquals("10%", $this->getText("test_basket_Vat_1001_1"));
        $this->assertEquals("101,00 €", $this->getText("test_basket_TotalPrice_1001_1"));
        //testing product with staffelpreis
            $this->assertEquals("60,00 €", $this->getText("test_basket_Price_1003_3"));
            $this->assertEquals("19%", $this->getText("test_basket_Vat_1003_3"));
            $this->assertEquals("360,00 €", $this->getText("test_basket_TotalPrice_1003_3"));
            $this->assertEquals("6", $this->getValue("test_basketAm_1003_3"));
            $this->type("test_basketAm_1003_3", "1");
            $this->clickAndWait("test_basketUpdate");
            $this->assertEquals("75,00 €", $this->getText("test_basket_Price_1003_3"));
            $this->assertEquals("19%", $this->getText("test_basket_Vat_1003_3"));
            $this->assertEquals("75,00 €", $this->getText("test_basket_TotalPrice_1003_3"));
            $this->type("test_basketAm_1003_3", "6");
            $this->clickAndWait("test_basketUpdate");
    }

    /*
     * Order steps (without any special checking for discounts, various VATs and user registration)
     * @group order
     * @group user
     * @group navigation
     */
    public function testFrontendOrderSteps4And5International()
    {
        $this->openShop();
        //adding products to the basket
        $this->type("//input[@id='f.search.param']", "100");
        $this->clickAndWait("test_searchGo");
        $this->select("selectList_Search_1001_0", "index=0");
        $this->clickAndWait("test_toBasket_Search_1001");
        $this->select("varSelect_Search_1002", "index=1");
        $this->clickAndWait("test_toBasket_Search_1002");
        $this->clickAndWait("link=Cart");
        $this->type("test_RightLogin_Email", "birute_test@nfq.lt");
        $this->type("test_RightLogin_Pwd", "useruser");
        $this->clickAndWait("test_RightLogin_Login");
        //Order Step1
        $this->type("voucherNr", "222222");
        $this->clickAndWait("test_basketVoucherAdd");
        $this->clickAndWait("test_BasketNextStepTop");
        //Order step2
        $this->clickAndWait("test_UserNextStepTop");
        //Order Step3
        $this->click("test_Payment_oxidcashondel");
        $this->clickAndWait("test_PaymentNextStepBottom");
        //Order Step4
        $this->assertTrue($this->isTextPresent("Please verify your input!"));
        $this->clickAndWait("test_orderWrapp_1001_1");
        $this->assertEquals("Test wrapping [EN] šųößлы", $this->getText("test_WrapItemName_1001_3"));
        $this->assertEquals("Test card [EN] šųößлы (0,20 €)", $this->getText("test_CardItemNamePrice_3"));
        $this->check("test_WrapItem_1001_3");
        $this->check("test_WrapItem_1002-2_3");
        $this->check("test_WrapItem_1001_NONE");
        $this->check("test_CardItem_3");
        $this->type("giftmessage", "Greeting card text");
        $this->clickAndWait("test_BackToOrder");
        //link to billing address
        $this->assertEquals("Billing Address eMail: birute_test@nfq.lt UserCompany įÄк Mr UserNameįÄк UserSurnameįÄк User additional info įÄк Musterstr.įÄк 1 79098 Musterstadt įÄк Germany Phone: 0800 111111", $this->clearString($this->getText("test_orderBillAdress")));
        $this->assertTrue($this->isTextPresent("What I wanted to say ...:"));
        $this->clickAndWait("test_orderChangeBillAdress");
        $this->assertEquals("You are here: / Login", $this->getText("path"));
        $this->type("order_remark", "what i wanted to say");
        $this->clickAndWait("test_UserNextStepTop");
        $this->clickAndWait("test_PaymentNextStepBottom");
        $this->assertTrue($this->isTextPresent("what i wanted to say"));
        //link to shipping address
        $this->assertEquals("Shipping Address", $this->getText("test_orderShipAdress"));
        $this->clickAndWait("test_orderChangeShipAdress");
        $this->assertEquals("You are here: / Login", $this->getText("path"));
        $this->clickAndWait("blshowshipaddress");
        $this->select("addressid", "label=New Address");
        sleep(1);
        $this->checkForErrors();
        $this->type("deladr[oxaddress__oxfname]", "firstįÄк");
        $this->type("deladr[oxaddress__oxlname]", "lastįÄк");
        $this->type("deladr[oxaddress__oxcompany]", "companyįÄк");
        $this->type("deladr[oxaddress__oxstreet]", "streetįÄк");
        $this->type("deladr[oxaddress__oxstreetnr]", "1");
        $this->type("deladr[oxaddress__oxzip]", "3000");
        $this->type("deladr[oxaddress__oxcity]", "cityįÄк");
        $this->select("deladr[oxaddress__oxcountryid]", "label=Germany");
        $this->clickAndWait("test_UserNextStepBottom");
        $this->clickAndWait("test_PaymentNextStepBottom");
        $this->assertEquals("Shipping Address companyįÄк Mr firstįÄк lastįÄк streetįÄк 1 3000 cityįÄк Germany", $this->clearString($this->getText("test_orderShipAdress")));
        //submit without checkbox
        $this->clickAndWait("test_OrderSubmitTop");
        $this->assertTrue($this->isTextPresent("Please read and confirm our terms and conditions."));
        //successful submit
        $this->check("test_OrderConfirmAGBBottom");
        $this->clickAndWait("test_OrderSubmitBottom");
        $this->assertEquals("You are here: / Order completed", $this->getText("path"));
        //testing info in 5th page
        $this->assertTrue($this->isTextPresent("We registered your order under the number: 12"));
        $this->assertTrue($this->isElementPresent("test_BackToShop"));
            $sShopName ="OXID eShop 4";
        $this->assertEquals("Back to Shop $sShopName.", $this->clearString($this->getText("test_BackToShop")));
        $this->clickAndWait("test_OrderHistory");
        $this->assertEquals("You are here: / My Account / Order History", $this->getText("path"));
        $this->assertEquals("Order History", $this->getText("test_accOrderHistoryHeader"));
        $this->assertEquals("Test product 1 [EN] šųößлы test selection list [EN] šųößлы : selvar1 [EN] įÄк +1,00 €", $this->clearString($this->getText("test_accOrderLink_12_1")));
        $this->assertEquals("Test product 2 [EN] šųößлы var2 [EN] šųößлы", $this->clearString($this->getText("test_accOrderLink_12_2")));
    }

    /*
     * Checking Top Menu Navigation
     * @group navigation
     */
    public function testFrontendTopMenuInternational()
    {
        $this->openShop();
        $this->assertFalse($this->isElementPresent("root2"));
        $this->assertTrue($this->isElementPresent("test_BoxLeft_Cat_testcategory0_2"));
        //activating top menu navigation
        oxDb::getDb()->Execute("DELETE FROM `oxconfig` WHERE `OXVARNAME` = 'iTopNaviCatCount';");
        oxDb::getDb()->Execute("DELETE FROM `oxconfig` WHERE `OXVARNAME` = 'blTopNaviLayout';");
            oxDb::getDb()->Execute("INSERT INTO `oxconfig` VALUES ('05ac5e8c1ed0309d1e1e9fe346', 'oxbaseshop', '', 'iTopNaviCatCount', 'str', 0xb6);");
            oxDb::getDb()->Execute("INSERT INTO `oxconfig` VALUES ('05acidyc1e85609d1e1e9qw346', 'oxbaseshop', '', 'blTopNaviLayout', 'bool', 0x93ea1218);");
        $this->openShop();
        $this->assertTrue($this->isElementPresent("root2"));
        $this->assertFalse($this->isElementPresent("test_BoxLeft_Cat_testcategory0_2"));
        $this->assertEquals("more", $this->getText("root3"));
        $this->assertEquals("Test category 0 [EN] šųößлы", $this->getText("root2"));
        $this->clickAndWait("root2");
        $this->assertEquals("Test category 0 [EN] šųößлы", $this->getText("test_BoxLeft_Cat_testcategory0_1"));
        $this->assertEquals("Test category 1 [EN] šųößлы", $this->getText("test_BoxLeft_Cat_testcategory0_sub1"));
        $this->assertEquals("Test category 1 [EN] šųößлы", $this->getText("test_Top_root2_SubCat_1"));
        $this->assertEquals("Test category 0 [EN] šųößлы", $this->getText("test_catTitle"));
        $this->clickAndWait("test_Top_root2_SubCat_1"); //new templates
        $this->assertEquals("Test category 1 [EN] šųößлы", $this->getText("test_catTitle"));
        $this->clickAndWait("root3");
        $this->assertEquals("Test category 0 [EN] šųößлы", $this->getText("test_CatRoot_2"));
        $this->assertEquals("Test category 1 [EN] šųößлы", $this->getText("test_CatRoot_2_SubCat_1"));
    }

    /*
     * Shop migration from International to Germany locale (#1707 from Mantis)
     * @group navigation
     */
    public function testMigrationInternationalToGermany()
    {
            $this->clearTmp();
            $this->loginAdmin("Master Settings", "Core Settings");
            $this->selectFrame("relative=top");
            $this->selectFrame("navigation");
            $this->assertFalse($this->isElementPresent("link=eCommerce Services"));
            $this->assertFalse($this->isElementPresent("link=Shop-Connector"));
            $this->assertTrue($this->isElementPresent("link=History"));
            $this->waitForElement("link=Master Settings");
            $this->checkForErrors();
            $this->click("link=Master Settings");
            $this->clickAndWaitFrame("link=Core Settings", "edit");
            //testing edit frame for errors
            $this->frame("edit", "btn.help");
            //testing list frame for errors
            $this->frame("list", "link=System");
            $this->openTab("link=System");
            $this->click("link=Other settings");
            sleep(1);
            $this->select("confstrs[sShopCountry]", "label=Germany, Austria, Switzerland");
            $this->clickAndWaitFrame("save", "list");
            $this->frame("list", "link=Settings");
            $this->openTab("link=Settings");
            $this->click("link=Administration");
            sleep(1);
            $this->check("//input[@name='confbools[blLoadDynContents]' and @value='true']");
            $this->clickAndWaitFrame("save", "list");
            $this->selectFrame("relative=up");
            $this->selectFrame("relative=up");
            $this->selectFrame("header");
            $this->assertTrue($this->isElementPresent("link=Logout"));
            $this->clickAndWait("link=Logout");
            $this->type("user","admin@myoxideshop.com");
            $this->type("pwd","admin0303");
            $this->select("chlanguage", "label=English");
            $this->select("profile", "label=Standard");
            $this->click("//input[@type='submit']");
            $this->waitForElement("nav");
            $this->selectFrame("relative=top");
            $this->selectFrame("basefrm");
            $this->waitForText("Welcome to the OXID eShop Admin");
            $this->checkForErrors();
            $this->selectFrame("relative=top");
            $this->selectFrame("navigation");
            $this->checkForErrors();
            $this->assertTrue($this->isElementPresent("link=Master Settings"));
            $this->assertTrue($this->isElementPresent("link=Shop Settings"));
            $this->assertTrue($this->isElementPresent("link=eCommerce Services"));
            $this->assertTrue($this->isElementPresent("link=Shop-Connector"));
            $this->assertTrue($this->isElementPresent("link=History"));
            //TODO: ask Arvydas why this frame is gone
            /*
            $this->selectFrame("relative=up");
            $this->selectFrame("adminfrm");
            $this->assertFalse($this->isTextPresent("Not Found"));
            */
            //checking if there are no errors in frontend
            $this->openShop();
    }
}