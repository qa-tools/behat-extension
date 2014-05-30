# frontend/features/login.feature
Feature: Login
	In order to use our site
	As a website user
	I need to login successfully

	@javascript @login @failing-login
	Scenario: Failing login due missing email
		Given "registered" as user
		And the user visits the "LoginPage"
		When the user fills the login form with missing "email"
		Then the login should fail
