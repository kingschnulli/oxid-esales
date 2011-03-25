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

class AcceptanceInternational_internationalTest extends oxidAdditionalSeleniumFunctions
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
    public function testCreateUserUtf8()
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
    public function testSeoCoreSettingsUtf8()
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
        $this->clickAndWait("link=Test category 0 [EN] šųößлы");
        $this->assertEquals("prefix EN šųößлы | Test category 0 [EN] šųößлы | suffix EN šųößлы", $this->getTitle());
    }

    /*
     * simple user account opening
     * @group user
     */
    public function testStandardUserRegistrationUtf8()
    {
        //creating user
        $this->openShop();
        $this->clickAndWait("//ul[@id='topMenu']//a[text()='Register']");
        $this->type("userLoginName", "birute01@nfq.lt");
        $this->type("userPassword", "user11");
        $this->type("userPasswordConfirm", "user11");
        $this->assertEquals("off", $this->getValue("//input[@name='blnewssubscribed' and @value='1']"));
      //  $this->uncheck("document.order.blnewssubscribed[1]");
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
        //TODO: is possibility to enter shipping address during registration is removed from azure?
        /*
        $this->clickAndWait("blshowshipaddress");
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
        */
        $this->clickAndWait("accUserSaveTop");
        $this->assertTrue($this->isTextPresent("We welcome you as registered user!"));
        $this->assertEquals("user1 name_šųößлы user1 last name_šųößлы", $this->getText("//ul[@id='topMenu']/li/a"));
        $this->assertEquals("You are here: / Register", $this->getText("breadCrumb"));

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
        //TODO: is possibility to enter shipping address during registration is removed from azure?
        /*
        $this->frame("list");
        $this->openTab("link=Addresses");
        $this->selectAndWait("oxaddressid", "label=user1_2 name_šųößлы user1_2 last name_šųößлы, user1_2 street_šųößлы, user1_2 city_šųößлы");
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
        */
    }

    /*
     * Checking Tags functionality
     * @group navigation
     */
    public function testFrontendTagsUtf8()
    {
        $this->clearTmp();
        $this->openShop();
        $this->assertTrue($this->isElementPresent("tagBox"));
        $this->assertEquals("Tags", $this->getText("//div[@id='tagBox']/h3"));
        $this->assertTrue($this->isElementPresent("//div[@id='tagBox']//a[text()='More...']"));
        $this->clickAndWait("//div[@id='tagBox']//a[text()='More...']");
        $this->assertEquals("You are here: / Tags", $this->getText("breadCrumb"));
        $this->assertEquals("Tags", $this->getText("//h1"));
        $this->assertTrue($this->isElementPresent("link=[EN]"));
        $this->assertTrue($this->isElementPresent("link=šųößлы"));
        $this->assertTrue($this->isElementPresent("link=tag"));
        $this->assertTrue($this->isElementPresent("link=1"));
        $this->assertTrue($this->isElementPresent("link=2"));
        $this->assertTrue($this->isElementPresent("link=3"));
        $this->clickAndWait("link=Home");

        $this->assertTrue($this->isElementPresent("//div[@id='tagBox']//a[text()='tag']"));
        $this->clickAndWait("//div[@id='tagBox']//a[text()='šųößлы']");
        $this->assertEquals("You are here: / Tags / Šųößлы", $this->getText("breadCrumb"));
        $this->assertEquals("Šųößлы", $this->getText("//h1"));
        $this->assertEquals("Test product 0 [EN] šųößлы", $this->getText("//ul[@id='productList']/li[1]/form//a"));
        $this->assertTrue($this->isElementPresent("//ul[@id='productList']/li[4]"));
        $this->assertFalse($this->isElementPresent("//ul[@id='productList']/li[5]"));

        $this->clickAndWait("//ul[@id='productList']/li[3]//a");
        $this->assertEquals("Test product 2 [EN] šųößлы", $this->getText("//h1"));
        $this->assertEquals("You are here: / Tags / Šųößлы", $this->getText("breadCrumb"));
        $this->assertFalse($this->isVisible("tags"));
        $this->assertEquals("Tags", $this->getText("//ul[@id='itemTabs']/li[2]"));
        $this->click("//ul[@id='itemTabs']/li[2]/a");
        $this->waitForItemAppear("tags");
        $this->assertTrue($this->isVisible("link=tag"));
        $this->loginInFrontend("birute_test@nfq.lt", "useruser");
        $this->assertEquals("Test product 2 [EN] šųößлы", $this->getText("//h1"));

        //adding new tag
//TODO: finish after functionality will be fully done
/*
        $this->assertFalse($this->isElementPresent("newTags"));
        $this->click("//ul[@id='itemTabs']/li[2]/a");
        $this->waitForItemAppear("tags");
        $this->click("editTag");
        $this->waitForItemAppear("newTags");
        $this->assertTrue($this->isTextPresent("Add tags:"));
        $this->type("newTags", "new_tag");
        $this->clickAndWait("saveTag");
        $this->assertTrue($this->isVisible("link=new_tag"));
        $this->clickAndWait("link=new_tag");
        $this->assertEquals("You are here: / Tags / new_tag", $this->getText("breadCrumb"));
        $this->assertEquals("New_tag", $this->getText("//h1"));
        $this->assertEquals("Test product 2 [EN] šųößлы", $this->getText("//ul[@id='productList']/li[1]/form//a"));
        $this->assertFalse($this->isElementPresent("//ul[@id='productList']/li[2]"));
*/
    }

    /*
     * Search in frontend
     * @group navigation
     */
    public function testFrontendSearchUtf8()
    {
        $this->openShop();
        //searching for 1 product (using product search field value)
        $this->searchFor("šųößлы1000");
        $this->assertEquals("You are here: / Search", $this->getText("breadCrumb"));
        $this->assertTrue($this->isElementPresent("rssSearchProducts"));
        $this->assertEquals("1 Hits for \"šųößлы1000\"", $this->getHeadingText("//h1"));
        $this->selectDropDown("viewOptions", "Line");
        $this->assertEquals("Test product 0 short desc [EN] šųößлы", $this->clearString($this->getText("//ul[@id='searchList']/li[1]//div[2]/div[2]")));
        $this->assertTrue($this->isElementPresent("//ul[@id='searchList']/li[1]//strong[text()='50,00 € *']"));
        $this->assertEquals("Test product 0 [EN] šųößлы", $this->clearString($this->getText("//ul[@id='searchList']/li[1]//div[2]//a")));
        $this->assertEquals("0", $this->getText("//div[@id='miniBasket']/span"));
        $this->type("amountToBasket_searchList_1", "3");
        $this->clickAndWait("toBasket_searchList_1");
        $this->assertEquals("3", $this->getText("//div[@id='miniBasket']/span"));

         //checking if all product links in relusts are working

        $this->clickAndWait("//ul[@id='searchList']/li[1]//a");
        $this->assertEquals("You are here: / Search result for \"šųößлы1000\"", $this->getText("breadCrumb"));
        $this->assertEquals("Test product 0 [EN] šųößлы", $this->getText("//h1"));

        //not existing search
        $this->searchFor("notExisting");
        $this->assertEquals("You are here: / Search", $this->getText("breadCrumb"));
        $this->assertTrue($this->isTextPresent("Sorry, no items found."));
        $this->assertEquals("0 Hits for \"notExisting\"", $this->getHeadingText("//h1"));

        //special chars search
        $this->searchFor("[EN] šųößлы");
        $this->assertEquals("You are here: / Search", $this->getText("breadCrumb"));
        $this->assertEquals("4 Hits for \"[EN] šųößлы\"", $this->getHeadingText("//h1"));
        $this->selectDropDown("viewOptions", "Line");
        $this->assertTrue($this->isElementPresent("//ul[@id='searchList']//a[text()='Test product 0 [EN] šųößлы']"));
        $this->assertTrue($this->isElementPresent("//ul[@id='searchList']//a[text()='Test product 1 [EN] šųößлы']"));
        $this->assertTrue($this->isElementPresent("//ul[@id='searchList']//a[text()='Test product 2 [EN] šųößлы']"));
        $this->assertTrue($this->isElementPresent("//ul[@id='searchList']//a[text()='Test product 3 [EN] šųößлы']"));
        $this->assertFalse($this->isElementPresent("//ul[@id='searchList']/li[5]"));
    }


    /*
     * My Account navigation: changing password
     * @group navigation
     * @group user
     */
    public function testFrontendMyAccountPassUtf8()
    {
        $this->openShop();
        $this->loginInFrontend("birute_test@nfq.lt", "useruser");
        $this->clickAndWait("//ul[@id='topMenu']/li/a");
        //changing password
        $this->assertEquals("You are here: / My Account / Personal Settings", $this->getText("breadCrumb"));
        $this->assertEquals("UserNameįÄк UserSurnameįÄк", $this->clearString($this->getText("//ul[@id='topMenu']/li/a")));
        $this->clickAndWait("//div[@id='sidebar']//li/a[text()='Personal Settings']");
        $this->assertEquals("Personal Settings", $this->getText("//h1"));

        //entered diff new passwords
        $this->type("passwordOld", "useruser");
        $this->type("password_new", "user1user");
        $this->type("password_new_confirm", "useruser");
        $this->click("savePass");
        $this->waitForText("Passwords don't match!");

        //new pass is too short
        $this->type("passwordOld", "useruser");
        $this->type("password_new", "user");
        $this->type("password_new_confirm", "user");
        $this->click("savePass");
        $this->waitForText("Error: your password is too short");
        $this->waitForText("Passwords don't match!");

        //correct new pass
        $this->type("passwordOld", "useruser");
        $this->type("password_new", "user1userįÄк");
        $this->type("password_new_confirm", "user1userįÄк");
        $this->clickAndWait("savePass");
        $this->assertFalse($this->isVisible("//span[text()='Error: your password is too short.']"));
        $this->assertFalse($this->isVisible('//span[text()="Passwords don\'t match!"]'));
        $this->assertEquals("Personal Settings", $this->getText("//h1"));
        $this->assertTrue($this->isTextPresent("Your Password has changed."));
        $this->clickAndWait("//ul[@id='topMenu']//a[text()='Logout']");

        $this->assertFalse($this->isTextPresent("Wrong e-Mail or password!"));
        $this->loginInFrontend("birute_test@nfq.lt", "useruser");
        $this->assertTrue($this->isTextPresent("Wrong e-Mail or password!"));
        $this->loginInFrontend("birute_test@nfq.lt", "user1userįÄк");
        $this->assertEquals("UserNameįÄк UserSurnameįÄк", $this->clearString($this->getText("//ul[@id='topMenu']/li[1]/a[1]")));
    }

    /*
     * Order steps: Step1
     * @group order
     * @group user
     * @group navigation
     */
    public function testFrontendOrderStep1Utf8()
    {
        $this->openShop();
        //adding products to the basket
        $this->searchFor("100");
        $this->selectDropDown("viewOptions", "Line");
        $this->select("selList_searchList_2_0", "index=2");
        $this->clickAndWait("toBasket_searchList_2");

        $this->select("varSelect_searchList_3", "index=1");
        $this->clickAndWait("toBasket_searchList_3");
        $this->type("amountToBasket_searchList_4", "6");
        $this->clickAndWait("toBasket_searchList_4");
        $this->clickAndWait("toBasket_searchList_1");

        $this->openBasket();
        $this->assertEquals("You are here: / View cart", $this->getText("breadCrumb"));
        $this->type("voucherNr", "222222");
        $this->clickAndWait("//button[text()='Submit Coupon']");
        $this->assertTrue($this->isTextPresent("Your Coupon “222222” couldn't be accepted."));
        $this->assertTrue($this->isTextPresent("The coupon is not valid for your user group!"));
        $this->loginInFrontend("birute_test@nfq.lt", "useruser");
        $this->type("voucherNr", "111111");
        $this->clickAndWait("//button[text()='Submit Coupon']");
        //Order Step1
        $this->assertEquals("Test product 1 [EN] šųößлы", $this->getText("//tr[@id='cartItem_1']/td[3]//a"));
        $this->assertEquals("Test product 2 [EN] šųößлы, var2 [EN] šųößлы", $this->getText("//tr[@id='cartItem_2']/td[3]//a"));
        $this->assertEquals("Test product 3 [EN] šųößлы", $this->getText("//tr[@id='cartItem_3']/td[3]//a"));
        $this->assertEquals("Test product 0 [EN] šųößлы", $this->getText("//tr[@id='cartItem_4']/td[3]//a"));
        $this->assertEquals("Art.No.: 1001", $this->getText("//tr[@id='cartItem_1']/td[3]/div[2]"));
        $this->assertEquals("Art.No.: 1002-2", $this->getText("//tr[@id='cartItem_2']/td[3]/div[2]"));
        $this->assertEquals("Art.No.: 1003", $this->getText("//tr[@id='cartItem_3']/td[3]/div[2]"));
        $this->assertEquals("Art.No.: 1000", $this->getText("//tr[@id='cartItem_4']/td[3]/div[2]"));
        //testing product with selection list
        $this->assertEquals("selvar3 [EN] įÄк -2,00 €", $this->getSelectedLabel("//tr[@id='cartItem_1']/td[3]//select"));
        $this->assertEquals("98,00 €", $this->getText("//tr[@id='cartItem_1']/td[6]"));
        $this->assertEquals("10%", $this->getText("//tr[@id='cartItem_1']/td[7]"));
        $this->assertEquals("98,00 €", $this->getText("//tr[@id='cartItem_1']/td[8]"));
        $this->select("//tr[@id='cartItem_1']/td[3]//select", "index=1");
        $this->clickAndWait("basketUpdate");
        $this->assertEquals("100,00 €", $this->getText("//tr[@id='cartItem_1']/td[6]"));
        $this->assertEquals("10%", $this->getText("//tr[@id='cartItem_1']/td[7]"));
        $this->assertEquals("100,00 €", $this->getText("//tr[@id='cartItem_1']/td[8]"));
        $this->select("//tr[@id='cartItem_1']/td[3]//select", "index=3");
        $this->clickAndWait("basketUpdate");
        $this->assertEquals("102,00 €", $this->getText("//tr[@id='cartItem_1']/td[6]"));
        $this->assertEquals("10%", $this->getText("//tr[@id='cartItem_1']/td[7]"));
        $this->assertEquals("102,00 €", $this->getText("//tr[@id='cartItem_1']/td[8]"));
        $this->select("//tr[@id='cartItem_1']/td[3]//select", "index=0");
        $this->clickAndWait("basketUpdate");
        $this->assertEquals("101,00 €", $this->getText("//tr[@id='cartItem_1']/td[6]"));
        $this->assertEquals("10%", $this->getText("//tr[@id='cartItem_1']/td[7]"));
        $this->assertEquals("101,00 €", $this->getText("//tr[@id='cartItem_1']/td[8]"));
        //testing product with staffelpreis
            $this->assertEquals("60,00 €", $this->getText("//tr[@id='cartItem_3']/td[6]"));
            $this->assertEquals("19%", $this->getText("//tr[@id='cartItem_3']/td[7]"));
            $this->assertEquals("360,00 €", $this->getText("//tr[@id='cartItem_3']/td[8]"));
            $this->assertEquals("6", $this->getValue("am_3"));
            $this->type("am_3", "1");
            $this->clickAndWait("basketUpdate");
            $this->assertEquals("75,00 €", $this->getText("//tr[@id='cartItem_3']/td[6]"));
            $this->assertEquals("19%", $this->getText("//tr[@id='cartItem_3']/td[7]"));
            $this->assertEquals("75,00 €", $this->getText("//tr[@id='cartItem_3']/td[8]"));
            $this->type("am_3", "6");
            $this->clickAndWait("basketUpdate");

        //discounts
        $this->assertTrue($this->isTextPresent("discount for category [EN] šųößлы"));
        $this->assertEquals("-10,00 €", $this->clearString($this->getText("//div[@id='basketSummary']//tr[2]/td")));
        $this->assertTrue($this->isTextPresent("discount for product [EN] šųößлы"));
        $this->assertEquals("Coupon (No. 111111) remove", $this->getText("//div[@id='basketSummary']//tr[8]/th"));
        $this->assertEquals("-10,00 €", $this->clearString($this->getText("//div[@id='basketSummary']//tr[8]/td")));
        $this->assertEquals("1,50 €", $this->getText("//div[@id='basketSummary']//tr[9]/td"));
            $this->assertEquals("-42,70 €", $this->getText("//div[@id='basketSummary']//tr[3]/td"));
            $this->assertEquals("578,00 €", $this->getText("//div[@id='basketSummary']//tr[1]/td"));
            $this->assertEquals("516,80 €", $this->getText("//div[@id='basketSummary']//tr[10]/td"));
            $this->assertEquals("444,45 €", $this->getText("//div[@id='basketSummary']//tr[4]/td"));
            $this->assertEquals("8,56 €", $this->getText("//div[@id='basketSummary']//tr[5]/td"));
            $this->assertEquals("60,19 €", $this->getText("//div[@id='basketSummary']//tr[6]/td"));
            $this->assertEquals("2,10 €", $this->getText("//div[@id='basketSummary']//tr[7]/td"));

        $this->clickAndWait("//div[@id='basketSummary']//tr[8]/th/a");
        $this->type("voucherNr", "222222");
        $this->clickAndWait("//button[text()='Submit Coupon']");

        //removing few articles
        $this->check("//tr[@id='cartItem_4']/td[1]//input");
        $this->check("//tr[@id='cartItem_3']/td[1]//input");
        $this->clickAndWait("basketRemove");

        //basket calculation
        $this->assertEquals("168,00 €", $this->getText("//div[@id='basketSummary']//tr[1]/td"));
        $this->assertTrue($this->isTextPresent("discount for category [EN] šųößлы"));
        $this->assertEquals("-5,00 €", $this->getText("//div[@id='basketSummary']//tr[2]/td"));
        $this->assertEquals("136,40 €", $this->getText("//div[@id='basketSummary']//tr[3]/td"));
        $this->assertEquals("8,29 €", $this->getText("//div[@id='basketSummary']//tr[4]/td"));
        $this->assertEquals("10,16 €", $this->getText("//div[@id='basketSummary']//tr[5]/td"));
        $this->assertEquals("-8,15 €", $this->clearString($this->getText("//div[@id='basketSummary']//tr[6]/td")));
        $this->assertEquals("1,50 €", $this->getText("//div[@id='basketSummary']//tr[7]/td"));
        $this->assertEquals("156,35 €", $this->getText("//div[@id='basketSummary']//tr[8]/td"));
    }

    /*
     * Order steps (without any special checking for discounts, various VATs and user registration)
     * @group order
     * @group user
     * @group navigation
     */
    public function testFrontendOrderSteps4And5Utf8()
    {
        $this->openShop();
        $this->searchFor("100");
        $this->selectDropDown("viewOptions", "Line");
        $this->select("//ul[@id='searchList']/li[2]//select", "index=0");
        $this->clickAndWait("//ul[@id='searchList']/li[2]//button");
        $this->select("//ul[@id='searchList']/li[3]//select", "index=1");
        $this->clickAndWait("//ul[@id='searchList']/li[3]//button");
        $this->openBasket();
        $this->loginInFrontend("birute_test@nfq.lt", "useruser");
        $this->type("voucherNr", "222222");
        $this->clickAndWait("//button[text()='Submit Coupon']");
        $this->clickAndWait("//button[text()='Continue to Next Step']");
        $this->clickAndWait("//button[text()='Continue to Next Step']");
        $this->assertEquals("Test S&H set [EN] šųößлы", $this->getSelectedLabel("sShipSet"));
        $this->selectAndWait("sShipSet", "label=Standard");
        $this->clickAndWait("//button[text()='Continue to Next Step']");
        //Order Step4
        //rights of withdrawal
        $this->assertTrue($this->isElementPresent("//form[@id='orderConfirmAgbBottom']//a[text()='Terms and Conditions']"));
        $this->assertTrue($this->isElementPresent("//form[@id='orderConfirmAgbBottom']//a[text()='Right to Cancel']"));
        $this->assertTrue($this->isElementPresent("//form[@id='orderConfirmAgbTop']//a[text()='Terms and Conditions']"));
        $this->assertTrue($this->isElementPresent("//form[@id='orderConfirmAgbTop']//a[text()='Right to Cancel']"));
        //testing links to products
        $this->clickAndWait("//tr[@id='cartItem_1']/td/a");
        $this->assertEquals("Test product 1 [EN] šųößлы", $this->getText("//h1"));
        $this->openBasket();
        $this->clickAndWait("//button[text()='Continue to Next Step']");
        $this->clickAndWait("//button[text()='Continue to Next Step']");
        $this->clickAndWait("//button[text()='Continue to Next Step']");

        $this->clickAndWait("//tr[@id='cartItem_2']/td[2]//a");
        $this->assertEquals("Test product 2 [EN] šųößлы var2 [EN] šųößлы", $this->getText("//h1"));
        $this->openBasket();
        $this->clickAndWait("//button[text()='Continue to Next Step']");
        $this->clickAndWait("//button[text()='Continue to Next Step']");
        $this->clickAndWait("//button[text()='Continue to Next Step']");
        //submit without checkbox
        $this->clickAndWait("//form[@id='orderConfirmAgbTop']//button");
        $this->assertTrue($this->isTextPresent("Please read and confirm our terms and conditions."));
        //successful submit
        $this->check("//form[@id='orderConfirmAgbBottom']//input[@name='ord_agb' and @value='1']");
        $this->clickAndWait("//form[@id='orderConfirmAgbBottom']//button");
        //testing info in 5th page
        $this->assertEquals("You are here: / Order Completed", $this->getText("breadCrumb"));
        $this->assertTrue($this->isTextPresent("We registered your order under the number: 12"));
        $this->assertTrue($this->isElementPresent("backToShop"));
        $this->assertEquals("back to Startpage", $this->getText("backToShop"));
        $this->clickAndWait("orderHistory");
        $this->assertEquals("You are here: / My Account / Order History", $this->getText("breadCrumb"));
        $this->assertEquals("Order History", $this->getText("//h1"));
        $this->assertEquals("Test product 1 [EN] šųößлы test selection list [EN] šųößлы : selvar1 [EN] įÄк +1,00 € - 1 qty.", $this->clearString($this->getText("//tr[@id='accOrderAmount_12_1']/td")));
        $this->assertEquals("Test product 2 [EN] šųößлы var2 [EN] šųößлы - 1 qty.", $this->clearString($this->getText("//tr[@id='accOrderAmount_12_2']/td")));
     }

    /*
     * Checking Top Menu Navigation
     * @group navigation
     */
    public function testFrontendTopMenuUtf8()
    {
        $this->openShop();
        $this->assertTrue($this->isVisible("navigation"));
        $this->assertEquals("Home", $this->clearString($this->getText("//ul[@id='navigation']/li[1]")));
        $this->assertEquals("Test category 0 [EN] šųößлы »", $this->clearString($this->getText("//ul[@id='navigation']/li[3]/a")));
        $this->assertFalse($this->isElementPresent("//ul[@id='tree']/li"));
        $this->clickAndWait("//ul[@id='navigation']/li[3]/a");

        $this->assertEquals("Test category 0 [EN] šųößлы", $this->getHeadingText("//h1"));
        $this->assertEquals("You are here: / Test category 0 [EN] šųößлы", $this->getText("breadCrumb"));
        $this->assertTrue($this->isElementPresent("//ul[@id='tree']/li"));
        $this->assertEquals("Test category 0 [EN] šųößлы", $this->clearString($this->getText("//ul[@id='tree']/li/a")));
        $this->assertEquals("Test category 1 [EN] šųößлы", $this->clearString($this->getText("//ul[@id='tree']/li/ul/li/a")));
        $this->selectDropDown("viewOptions", "Line");
        $this->assertTrue($this->isElementPresent("//ul[@id='productList']//a[text()='Test product 0 [EN] šųößлы']"));
        $this->assertTrue($this->isElementPresent("//ul[@id='productList']//a[text()='Test product 1 [EN] šųößлы']"));
        $this->assertTrue($this->isElementPresent("//ul[@id='productList']/li[2]"));
        $this->assertFalse($this->isElementPresent("//ul[@id='productList']/li[3]"));

        $this->clickAndWait("//ul[@id='tree']/li/ul/li/a");
        $this->assertTrue($this->isElementPresent("//ul[@id='tree']/li"));
        $this->assertEquals("Test category 0 [EN] šųößлы", $this->clearString($this->getText("//ul[@id='tree']/li/a")));
        $this->assertEquals("Test category 1 [EN] šųößлы", $this->clearString($this->getText("//ul[@id='tree']/li/ul/li/a")));
        $this->assertEquals("Test category 1 [EN] šųößлы", $this->getHeadingText("//h1"));
        $this->assertEquals("Test category 1 [EN] šųößлы", $this->getHeadingText("//h1"));
        $this->assertEquals("You are here: / Test category 0 [EN] šųößлы / Test category 1 [EN] šųößлы", $this->getText("breadCrumb"));
        $this->selectDropDown("viewOptions", "Line");
        $this->assertTrue($this->isElementPresent("//ul[@id='productList']//a[text()='Test product 2 [EN] šųößлы']"));
        $this->assertTrue($this->isElementPresent("//ul[@id='productList']//a[text()='Test product 3 [EN] šųößлы']"));
        $this->assertTrue($this->isElementPresent("//ul[@id='productList']/li[2]"));
        $this->assertFalse($this->isElementPresent("//ul[@id='productList']/li[3]"));

        //more
        $this->clickAndWait("//ul[@id='navigation']/li[4]/a");
        $this->assertTrue($this->isElementPresent("//ul[@id='navigation']/li[4]"));
        $this->assertEquals("More »", $this->getText("//ul[@id='navigation']/li[4]/a"));
        $this->assertFalse($this->isElementPresent("//ul[@id='navigation']/li[5]"));
        $this->executeSql("UPDATE `oxconfig` SET `OXVARVALUE` = 0xfb WHERE `OXVARNAME` = 'iTopNaviCatCount';");
        $this->openShop();
        $this->assertTrue($this->isElementPresent("//ul[@id='navigation']/li[5]"));
        $this->assertEquals("More »", $this->getText("//ul[@id='navigation']/li[5]/a"));
        $this->assertFalse($this->isElementPresent("//ul[@id='navigation']/li[6]"));
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