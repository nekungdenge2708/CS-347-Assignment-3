Given /^I visit the soduckso webapp$/ do
  visit ui_url '/food.php'
end
 
When /^I search for "(.*?)"$/ do |search_term|
  fill_in('"food"', :with => search_term)
  @matching_titles = ['quesadillas']
end
 
Then /^I only see food items matching the searched item$/ do
  @matching_titles.each do |title|
    page.should have_content title
  end
end