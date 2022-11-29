# ISM Connect REST Standard
The Laravel-based API for ISM Connect.

## Branching conventions
1. For new features: `feat-short-desc-#issue`
2. For patches (short bug fixes quickly done after an actual push): `patch-short-desc-#issue`
3. For bug fixes (fixes for a bug noticed anytime in the lifecycle, does not have to be a quick release): `bugfix-short-desc-#issue`
4. For hot fixes (hopefully, we'll never have to release these): `hotfix-short-desc-#issue`
5. For refactorings that do not introduce any new feature but just organise the code better: `refactor-short-desc-#issue`
6. For simple version upgrades or routine key changing: `chore-short-desc-#issue`

## Commit conventions
1. Commit only related items together
2. Add short descriptions to commits:
    a. Start with the issue number (and, if required, the point in that issue)
    b. A pointed description: You can keep them clean by simply committing things more often and adding only specific changes in a commit
    c. Commit messages are always in passive voice. Don't write: `Added dependency for JWTs`. Instead write, `Add dependency for JWT`
3. For example the following are good commit descriptions:
    > #3: Create migration to add password column to User table <br>
    > #12: Add query parsing for search requests
4. [TOUGH CALL] You don't always have to write the long descriptions

## REST endpoint conventions
0. The web app will be hosted at root. Possibly, [https://ismconnect.iitism.ac.in](https://ismconnect.iitism.ac.in).
1. The API will be hosted at sub path `/api/v1`. Possibly, [https://ismconnect.iitism.ac.in/api/v1](https://ismconnect.iitism.ac.in/api/v1).
2. Endpoints that delegate to models are always plural: use `/api/v1/users` and not `api/v1/user`.
3. There's queries to check now.

## Authentication convention


## PR conventions
1. If the issue is not already created, create it before you create a PR.
2. Always make a PR.
3. Assign someone to it.
4. Assign a reviewer.

### Naming:
0. Similar to commit messages
1. Put `[WIP]` in front of the PR title if you are still working on it
2. Put `[BREAKING]` in front of the title if it introduces changes that can potentially cause merge conflicts for others or even just plain break their code

### Descriptions:
Put closing statements in your PR descriptions that will close issues.
For example, if the PR will close issues #5 and #10, the first lines of the PR should be the following:
```md
Closes #5
Closes #10
```

This will link issues # 5 and #10 to your PR and automatically close them when the PR is merged. Saves time for you.

## Merging conventions
Two main branches:
1. `dev`
2. `main`

Always push to your branch and then merge with `dev`. Never merge with `main` unless you've spoken with others first. Main is our production code. It should always be stable.
