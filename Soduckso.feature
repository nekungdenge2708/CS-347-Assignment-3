#encoding: utf-8
Feature: Editing content
	To ensure that searching for food in the search bar returns the correct food item 
	As a User
	I should be able to see the correct output
	
	Scenario: Search for Foods
		Given I visit the soduckso webapp
		When I search for "item"
		Then I only see food items matching the searched item