import { beforeAll, afterAll, afterEach } from "vitest";
import { setupServer } from "msw/node";
import { rest } from "msw";

const habits = {
    data: [
        {
            name: 'Drink water',
            times_per_day: 3,
            executions_count: 1
        }
    ]
}

export const requestHandlers = [
    rest.get('http://localhost:3000/api/habits', (req, res, ctx) => {
        return res(ctx.status(200), ctx.json(habits))
    }),

    rest.post('http://localhost:3000/api/habits/:habit/execute', (req, res, ctx) => {
        return res(ctx.status(200), ctx.json({}))
    })
]

const server = setupServer(...requestHandlers)

beforeAll(() => server.listen({ onUnhandledRequest: 'error' }))

afterAll(() => server.close)

afterEach(() => server.resetHandlers())
