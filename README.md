# Domain Driven Design Sandbox : Biologist Sample Testing ERP

Help learning Domain Driven Design concepts via a very documented sandbox project

## Intention

Ease the learning curve necessary to learn Domain Driven Design (DDD) concepts.
As there are kinda puzzling at first for those who don't tried DDD yet.

Use a rather complex project sandbox simulating a live project in order to show most of DDD concepts in a real context.
And how a well a structured code can become very readable without tons of specifications by any developer.
And this whatever the project complexity.

## Who is this for

This is a pragmatic approach of DDD concepts aiming at beginners.
And also for individuals knowing nothing at these concepts joining a DDD Dev Team.
But who have not enough time to read the whole DDD books.

The goal is to lead readers to roughly understand the purpose of each concepts and where everything should be located.
This could be seen as a beginner cheatsheet for a Symfony2 project aiming to keep a good maintainability in the long term.


Experts might see this sandbox as taking some freedom regarding DDD theory.
Use at your own risk.

## How to use it

The project is very (very) documented.
See `@hint` annotation in code comments.

The project is not indented to be run, but rather simply browsed via GitHub or via an IDE.

You can also read commit messages (via the git blame feature) in order to better understand intentions behind code.

We have several area which could contains information:

- Specifications (Rarely up to date)
- Comments (Rarely up to date)
- Code (Always up to date)
- Tests (Always up to date)
- Commits (Always up to date)

We will try to put domain information into "Always up to date" area.

## Sandbox subject - Biologic Sample Testing ERP

The aim is to ease life of biologists using testing machines to analyze biologist samples.
These testing machines needs various consumables to perform an analysis.
Consumable deliveries take at least 2 weeks to be received.
Running short of consumables means delaying research by weeks.

Automatic anticipation would lead research to be completed faster.
As biologists will be able to focus on their research rather than on logistic.

The `Biologic Sample Testing ERP` will receive REST HTTP requests from these testing machines indicating an analyze has been launched.
Hence that a consumable has been consumed.
And when a threshold is reached automatically contact via REST HTTP requests consumable suppliers in order to request a new delivery.

## Disclaimer

This sandbox is the result from about 1 year using actively DDD concepts on live customer project.
This reflects my current understanding of DDD.

This can be considered as a pragmatic approach in a real word environment for beginners perspective.
The idea being to prevent beginners in your teams:
- who don't want to be convinced by reading DDD books
- who are usually reluctant to changes
- who could see DDD as only a set of constraints changing there habits.

to be reluctant at your approach.

But rather to present DDD as something which is not so intrusive yet very good for project maintainability.
And in avoiding misunderstandings between
- Developers and Domain experts
- Developers and Developers

## Credits

[Timothée Barray (@tyx)](https://github.com/tyx) - Software Architect at VeryLastRoom - for the overall DDD project structure.
