# frontend/features/login.feature
Feature: Login
	In order to use our site
	As a website user
	I need to login successfully

	@javascript @login @failing-login
	Scenario: Testscenario
		Given the user visits the "TestPage"
		When the user does the tests
		And the user waits for 10 seconds
