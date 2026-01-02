---
description: Start working on a specific task from an epic
---

# /pm:task-start - Start Task

Begin work on a specific task with full context loading.

## Usage
```
/pm:task-start <feature-name> <task-number>
```

## Prerequisites
1. Verify task exists: `.agent/epics/<feature-name>/<task-number>.md`
2. Check task dependencies are completed
3. Check task is not already in-progress or completed

## Workflow

### 1. Load Context
- Read epic: `.agent/epics/<feature-name>/epic.md`
- Read task: `.agent/epics/<feature-name>/<task-number>.md`
- Read related PRD if needed

### 2. Update Task Status
Update task frontmatter:
```yaml
status: in-progress
updated: <current ISO datetime>
started: <current ISO datetime>
```

### 3. Create Progress File
Create: `.agent/epics/<feature-name>/updates/<task-number>-progress.md`

```markdown
---
task: <task-number>
started: <current ISO datetime>
last_update: <current ISO datetime>
---

# Progress: <Task Title>

## Work Log

### <timestamp>
- Started task
- Initial analysis

## Blockers
- None currently

## Next Steps
- Step 1
- Step 2
```

### 4. Implementation Guidelines
- Focus ONLY on this task's scope
- Follow acceptance criteria exactly
- Commit frequently with meaningful messages
- Update progress file as work progresses

### 5. Completion
When task is done:
1. Update task status to "completed"
2. Update progress file with summary
3. Suggest: "Ready for next task? Run: /pm:next <feature-name>"

## Context Preservation
- Keep main thread focused on task
- Use progress files for detailed notes
- Don't pollute context with unrelated code
