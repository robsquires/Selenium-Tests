Feature: Application behaviour implemented using CSS

    Scenario: User is shown text when they hover over an element
        Given I am on "test.html"
         When I hover over the element "#parent"
         Then I should see "I've been hovered" in the "#child" element
