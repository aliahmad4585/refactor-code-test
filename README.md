# refactor-code-test

It seems that you have merged the code from different files into these two files.
1. BookingController
2. BookingRepository

The code does not looks good in terms of clean code. It requires a lot of refactoring. It does not follow the proper structure.
1. We can use the request classes for request validation. you have put the validation into repository classes.
2. The repository pattern should only use when we need to interact with database. This is a abstraction layer between and this should be centralized 
even we change the database, it should not affect the database logic.
  1. The current code is using repository pattern to validate the data
  2. The current code is performing some operation which are not related to db
3. The code has not used the service pattern. The logical operation related to BookingController.php should be performed in BookingService.php
4. The code has not followed the SOLID principle. One function is performing multiple operations/scenaris.
5. Code repetition is on its peak. Lets take example of getUsersJobsHistory() where response will be same but we are returning in both block. Similary store function has response['message'] key which is repeating.
6. We should used model policies to perform operations which current code does not use
7. Roles/Permission handled through env. Guards can be used to handled these.
8. Events should be used to dispatch queues.
9. The functions lines are exceeding according to prs rules
10. The more refactoring can be done in the context of bussiness


# What makes it amazing code.

1. Code should be readable and maintaible.
2. Followed the proper structure 
   1. Controller only used for invokation 
   2. Services should use to handle logical operation
   3. Request classes should handle to validation
   4. Repository pattern should only used to handle the database logic
   5. Polices/Guards/Permission structure should use to handle role based operations for super admin or other roles
   6. Events/queues should be separate
   7. Throthling can be handled in Providers 
   8. complex logic should have comments before the starting line.
   9. response structure should be defined

# What makes it ok code.
 1. put all the logic at controller level
 2. Atlease it should the file structure of the Laravel
 3. It should be readable
 4. Mutilple things can the handle at frontend level and send the filtered data to backend to avoid multiple if else statements


# what makes it terrible code.
The current code looks terrible because it does not follow any rules. its looks cluttered. One function  performing multiple operations. Code is repetative. It can do the job but its harder to maintain. 
