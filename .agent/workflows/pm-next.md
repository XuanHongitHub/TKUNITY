---
description: Show next priority task to work on with full context
---

# /pm:next - Get Next Priority Task

Intelligently determine and display the next task to work on.

## Usage
```
/pm:next [feature-name]
```

If feature-name provided, limit to that epic. Otherwise, show across all epics.

## Priority Algorithm

1. **Filter eligible tasks**:
   - Status = "open"
   - All dependencies completed
   - Not blocked

2. **Rank by priority**:
   - Tasks with `priority: high` first
   - Tasks that unblock other tasks
   - Parallel tasks (can be worked alongside others)
   - Earlier numbered tasks

3. **Display recommendation**:

```markdown
## 🎯 Next Recommended Task

### Epic: <feature-name>
### Task: <task-number> - <Task Title>

**Why this task?**
- Dependencies met: [list]
- Unblocks: [X other tasks]
- Effort: [S/M/L]

**Quick Context:**
<Brief task description>

**Acceptance Criteria:**
- [ ] Criterion 1
- [ ] Criterion 2

**Files Likely Affected:**
- path/to/file1
- path/to/file2

---

Ready to start? Run: `/pm:task-start <feature-name> <task-number>`
```

## Parallel Opportunities

Also show if there are tasks that can run in parallel:

```markdown
## ⚡ Parallel Opportunities

These tasks have no conflicts and can run simultaneously:
- Task 003: Database migrations
- Task 005: UI components

Consider running multiple Claude instances for faster delivery.
```
