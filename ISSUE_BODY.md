**Problem:**
The repository currently lacks a Continuous Integration (CI) pipeline. All checks, such as code linting, style consistency, and running tests, must be performed manually. This can lead to inconsistencies and makes it harder to maintain code quality.

**Proposed Solution:**
Implement a CI pipeline using GitHub Actions to automate the following tasks on every push and pull request:
1. **Linting:** Check the PHP code for syntax errors and style issues.
2. **Testing:** Run any automated tests if they are added in the future.

**Benefits:**
- **Improved Code Quality:** Automatically enforce coding standards.
- **Early Bug Detection:** Catch errors before they are merged into the main branch.
- **Increased Efficiency:** Automate repetitive manual checks.