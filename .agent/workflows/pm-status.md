---
description: Show overall project status and progress dashboard
---

# /pm:status - Project Status Dashboard

Display comprehensive project status including all PRDs, epics, and tasks.

## Usage
```
/pm:status
```

## Output Format

```markdown
# 📊 Project Status Dashboard

## PRDs
| Name | Status | Epic Created |
|------|--------|--------------|
| feature-1 | in-progress | ✅ |
| feature-2 | backlog | ❌ |

## Epics
| Name | Progress | Tasks | Open | In Progress | Completed |
|------|----------|-------|------|-------------|-----------|
| feature-1 | 60% | 5 | 1 | 1 | 3 |

## Active Tasks
| Epic | Task | Status | Assignee |
|------|------|--------|----------|
| feature-1 | 004 | in-progress | AI |

## Blocked Tasks
None currently

## Next Recommended Actions
1. Complete task 004 in feature-1
2. Start task 005 (no dependencies)
```

## Instructions

1. **Scan directories**:
   - `.agent/prds/` for PRDs
   - `.agent/epics/` for epics and tasks

2. **Parse frontmatter** from each file to get status

3. **Calculate progress**:
   - Epic progress = completed tasks / total tasks

4. **Identify blocked tasks**:
   - Tasks with uncompleted dependencies

5. **Suggest next actions** based on:
   - Priority of tasks
   - Dependency chains
   - Parallel execution opportunities
