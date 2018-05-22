# Searchmetrics PHP Senior Position Test
First and foremost thank you for applying for the position. In this repository you'll find the sources necessary for the
hiring challenge which are part of the later steps of our interview process.

We value the time you're putting in applying for the position, which is why you're free to complete as many (or little)
of the tasks in the upcoming list. The expected and optional tasks below should not take you longer than an hour,
and the bonus tasks should not take longer than another hour on top of that.

Please clone this repository and put it under your own version control, be it on GitHub, Bitbucket (they offer free private repositories),
and send us the link to the repository after you're done. We do not allow forking in order to prevent other interviewee from seeing the
results of others, and to protect everyone's privacy.

## Requirements
- PHP >= 7.1 and [Composer](https://getcomposer.org/) in whichever flavor (installed locally, mounted into a VM, via [Docker](https://docs.docker.com/install/), ...)

## Tasks
- Tasks marked with **[x]** are expected to be completed
- Tasks marked with **[o]** are optional, but appreciated if completed
- Tasks marked with **[.]** are bonuses

---

- **[x]** Implement the missing code to make the tests run successfully
- **[x]** Provide and implement at least one (1) other implementation of the `UrlIdGenerator` interface, including tests - DB, local/remote filesystem, external API - feel free to mock these! 
- **[o]** Provide a runnable environment of some kind (VM, Docker) in which the tests are still running successfully
- **[o]** Extend the environment to be able to run an integration test with your implementation against it and write that integration test
- **[.]** Extend the environment further with a small HTTP service allowing consumers to look up the URL ID for a URL they provide
