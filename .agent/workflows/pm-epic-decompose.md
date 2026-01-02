---
description: Break an epic into concrete, actionable tasks
---

# /pm:epic-decompose - Decompose Epic to Tasks

Break an epic into specific, actionable tasks with clear acceptance criteria.

## Usage
```
/pm:epic-decompose <feature-name>
```

## Prerequisites
1. Verify epic exists: `.agent/epics/<feature-name>/epic.md`
2. Check for existing tasks and ask to overwrite if found

## Task File Format

Create files: `.agent/epics/<feature-name>/001.md`, `002.md`, etc.

```markdown
---
name: <Task Title>
status: open
created: <current ISO datetime>
updated: <current ISO datetime>
depends_on: []      # List of task numbers: [001, 002]
parallel: true      # Can run in parallel with other tasks?
conflicts_with: []  # Tasks modifying same files: [003]
---

# Task: <Task Title>

## Description
Clear, concise description of what needs to be done

## Acceptance Criteria
- [ ] Specific criterion 1
- [ ] Specific criterion 2
- [ ] Specific criterion 3

## Technical Details
- Implementation approach
- Key considerations
- Files affected

## Dependencies
- [ ] Task dependencies
- [ ] External dependencies

## Effort Estimate
- Size: XS/S/M/L/XL
- Hours: Estimated hours
- Parallel: true/false

## Definition of Done
- [ ] Code implemented
- [ ] Tests written and passing
- [ ] Documentation updated
- [ ] Code reviewed
```

## Task Types to Consider
- **Setup**: Environment, dependencies, scaffolding
- **Data**: Models, schemas, migrations
- **API**: Endpoints, services, integration
- **UI**: Components, pages, styling
- **Testing**: Unit tests, integration tests
- **Docs**: README, API documentation

## Parallelization Rules
- Mark tasks with `parallel: true` if they can run simultaneously
- Set `conflicts_with` for tasks modifying same files
- Use `depends_on` for tasks that must wait for others

## Post-Decomposition
1. Update epic with task summary
2. Confirm: "✅ Created X tasks for epic: <feature-name>"
3. Show parallel vs sequential breakdown
4. Suggest next step: "Start work with: /pm:task-start <feature-name> 001"
