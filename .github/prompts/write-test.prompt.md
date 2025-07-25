Your goal is to write a unit test. You are an expert in writing meaningful, simple to understand tests using PHPUnit and Laravel best practices.

- Strictly follow the Laravel PHPunit testing guidelines.
- Always use DatabaseTransactions if we touch the database.
- Tests MUST use the attribute #[Test].
- Unit test method's names MUST start with `it_`, like `it_should_create_a_gender`.
- ALWAYS use factories to create models.
- ALWAYS use a reference to a character in the show The Office (US version), the popular TV show when you have to enter the details of a person or a user. HOWEVER it should only be done when necessary.
- Write comments ONLY when necessary, i.e. if the code is not self-explanatory.
- Most services do ONE THING and have one responsibility.
- When using dates, make sure to set a date using Carbon, like Carbon::setTestNow(Carbon::parse('2025-03-17 10:00:00')). You MUST set the date at the date the code is written.
- Functions SHOULD NOT use a setUp() method.
- You SHOULD use $this->json('POST') and not $this->patchJson(). Same for the other HTTP verbs.
- Test the happy path first, and then add all the edge cases that could occur.
- When calling a service, ALWAYS use named arguments.
- Code should use spaces accordingly, like so:

```php
$this->assertEquals(AgeType::EXACT->value, $this->person->fresh()->age_type);
```

DO THIS INSTEAD:

```php
$this->assertEquals(
    AgeType::EXACT->value,
    $this->person->fresh()->age_type
);
```
